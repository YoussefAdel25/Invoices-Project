<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Models\section;
use App\Notifications\addInvoice;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{

    public function index()
    {

        $invoices = invoices::all();
        return view('invoices.invoices', compact('invoices'));
    }


    public function create()
    {
        $sections = section::all();
        return view('invoices.add_invoice', compact('sections'));
    }


    public function store(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'discount' => $request->Discount,
            'value_rat' => $request->Value_VAT,
            'rate_vat' => $request->Rate_VAT,
            'total' => $request->Total,
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => $request->note,

        ]);

        $invoiceId = invoices::latest()->first()->id;

        invoices_details::create([
            'invoice_id' => $invoiceId,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section,
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name)


        ]);

        if ($request->hasFile('pic')) {

            $invoiceId = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attachments();
            $attachments->invoice_number = $invoice_number;
            $attachments->file_name = $file_name;
            $attachments->created_by = Auth::user()->name;
            $attachments->invoice_id = $invoiceId;
            $attachments->save();




            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }


        $user = User::get();
        $invoices = invoices::latest()->first();
        // $user->notify(new addInvoice($invoices));
        Notification::send($user, new addInvoice($invoices));

        session()->flash('add_invoice');
        return back();
    }



    public function show(invoices $invoices)
    {
        //
    }


    public function edit($id)
    {

        $invoices = invoices::where('id', $id)->first();
        $sections = section::all();

        return view('invoices.edit_invoice')->with('invoices', $invoices)->with('sections', $sections);
    }


    public function update(Request $request)
    {


        $invoices = invoices::findOrFail($request->invoice_id);

        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'discount' => $request->Discount,
            'value_rat' => $request->Value_VAT,
            'rate_vat' => $request->Rate_VAT,
            'total' => $request->Total,
            'note' => $request->note,


        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return back();
    }

    public function destroy(Request $request)
    {
        $id = $request->invoice_id;

        // البحث عن الفاتورة
        $invoice = invoices::find($id);

        // التأكد أن الفاتورة موجودة
        if (!$invoice) {
            return redirect()->route('invoices.index')->with('error', 'الفاتورة غير موجودة.');
        }

        // جلب الملفات المرتبطة بالفاتورة
        $details = invoices_attachments::where('invoice_id', $id)->get();
        foreach ($details as $d) {
            $file_path = public_path('Attachments/' . $d->invoice_number . '/' . $d->file_name);
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $folder_path = public_path('Attachments/' . $d->invoice_number);
            if (is_dir($folder_path) && count(scandir($folder_path)) == 2) {
                rmdir($folder_path);
            }
        }

        $invoice->forceDelete();
        session()->flash('delete_invoice');


        return redirect()->route('invoices.index');
    }


    public function ShowStatus($id)
    {


        $invoices = invoices::where('id', $id)->first();

        return view('invoices.edit_status')->with('invoices', $invoices);
    }

    public function StatusUpdate(Request $request, $id)
    {
        $invoice = invoices::findOrFail($id);

        if ($request->status == "مدفوعة") {
            $invoice->update([
                'value_status' => 1,
                'status' => $request->status,
                'payment_date' => $request->payment_date,

            ]);
            invoices_details::create([
                'invoice_id' => $id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,

                'note' => $request->note,
                'value_status' => 1,
                'status' => $request->status,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name)
            ]);
        } else {
            $invoice->update([
                'value_status' => 3,
                'status' => $request->status,
                'payment_date' => $request->payment_date
            ]);
            invoices_details::create([
                'invoice_id' => $id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,

                'note' => $request->note,
                'value_status' => 3,
                'status' => $request->status,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name)
            ]);
        }

        session()->flash('Status_Update');
        return redirect()->route('invoices.index');
    }


    public function archive(Request $request)
    {

        $invoices = invoices::where('id', $request->invoice_id);

        $invoices->delete();

        session()->flash('archive_invoice');
        return redirect('/invoices');
    }


    public function view_archived()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.archive_invoices')->with('invoices', $invoices);
    }


    public function delete_archived(Request $request)
    {
        $invoices = invoices::withTrashed()->where('id', $request->invoice_id)->first();
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/archive');
    }

    public function restore_archived(Request $request)
    {

        $id = $request->invoice_id;
        invoices::withTrashed()->where('id', $id)->restore();

        session()->flash('restore_invoice');
        return redirect('/invoices_archive');
    }



    public function getproducts($id)
    {
        $products = Product::where('section_id', $id)->pluck('product_name', 'id');
        return response()->json($products);
    }


    public function paidInvoices()
    {
        $invoices = invoices::where('value_status', 1)->get();
        return view('invoices.paidInvoices')->with('invoices', $invoices);
    }

    public function unpaidInvoices()
    {
        $invoices = invoices::where('value_status', 2)->get();
        return view('invoices.unpaidInvoices')->with('invoices', $invoices);
    }


    public function partialInvoices()
    {
        $invoices = invoices::where('value_status', 3)->get();
        return view('invoices.partialInvoices')->with('invoices', $invoices);
    }


    public function print_invoice($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.printInvoices')->with('invoices', $invoices);
    }

    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }


    public function MarkAllRead(Request $request)
    {

        $unreadNotification = Auth::user()->unreadNotifications;

        if ($unreadNotification) {
            $unreadNotification->markAsRead();
            return back();
        }
    }


    public function markNotificationAsRead($id)
    {
        $notification = auth()->user()->unreadNotifications->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['status' => 'success']);
    }
}
