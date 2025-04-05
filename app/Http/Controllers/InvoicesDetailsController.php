<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Models\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class InvoicesDetailsController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }



    public function store(Request $request)
    {
        //
    }

    public function show(invoices_details $invoices_details)
    {
        //
    }


    public function edit($id)
    {
        $invoices=invoices::where('id',$id)->first();
        $details=invoices_details::where('invoice_id',$id)->get();
        $attachments=invoices_attachments::where('invoice_id',$id)->get();
        return view('invoices.InvoiceDetails')
        ->with('invoices',$invoices)
        ->with('details',$details)
        ->with('attachments',$attachments);
    }


    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }


    public function destroy(Request $request)
    {
        $invoice=invoices_attachments::findOrFail($request->id_file);
        $invoice->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete','تم حذف المرفق بنجاح');
        return back();

    }

    public function open_file($invoice_number, $file_name)
    {
        // $filePath = Storage::disk('public_uploads')->path($invoice_number/$file_name);
        // public_uploads($invoice_number/$file_name);

        $filePath= "F:/invoices/public/Attachments/$invoice_number/$file_name"; // المسار الكامل للملف

        // تحديد نوع المحتوى حسب نوع الملف
        // $mimeType = mime_content_type($filePath);
        return response()->file($filePath);

        // return response()->file($filePath, [
        //     'Content-Type' => $mimeType,
        //     'Content-Disposition' => 'inline', // عرض الملف بدلاً من تنزيله
        // ]);
    }


    public function download_file($invoice_number,$file_name){
        $file_path= "F:/invoices/public/attachments/$invoice_number/$file_name";

        $mimeType = mime_content_type($file_path);

        return response()->download($file_path);
    }


}
