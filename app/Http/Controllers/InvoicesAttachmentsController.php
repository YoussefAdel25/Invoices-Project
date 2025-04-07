<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachmentsController extends Controller
{



    public function store(Request $request)
    {
        $this->validate($request,[


            'file_name' => 'mimes:pdf,jpeg,png,jpg',

        ], [
            'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
        ]);

        $image = $request->file('file_name');
        $fileName = $image->getClientOriginalName();

        $attach = new invoices_attachments();
        $attach->file_name = $fileName;
        $attach->invoice_number = $request->invoice_number;
        $attach->invoice_id = $request->invoice_id;
        $attach->created_by = Auth::user()->name;
        $attach->save();


        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/'.$request->invoice_number),$imageName);
        session()->flash('Add','تم اضافة المرفق بنجاح');
        return back();


    }


}
