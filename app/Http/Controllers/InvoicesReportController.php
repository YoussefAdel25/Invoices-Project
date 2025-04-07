<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class InvoicesReportController extends Controller
{
    public function index()
    {

        return view('reports.invoices');
    }

    public function searchInvoices(Request $request)
    {

        $radio = $request->radio;
        $type = $request->type;
        $startDate = date($request->start_at);
        $endDate = date($request->end_at);
        $invoice_number = $request->invoice_number;


        if ($radio == 1) {

            if ($type && $startDate = '' && $endDate = '') {


                $invoices = invoices::select('*')->where('status', $type)->get();
                return view('reports.invoices')->with('type', $type)->with('invoices', $invoices);
            } else {

                $invoices = invoices::whereBetween('invoice_date',[$startDate,$endDate])->where('status','=',$type)->get();
                return view('reports.invoices', compact('type', 'startDate', 'endDate', 'invoices'));

            }

        } else {

            $invoices = invoices::where('invoice_number', $invoice_number)->get();
            return view('reports.invoices')->with('invoices', $invoices);
        }
    }
}
