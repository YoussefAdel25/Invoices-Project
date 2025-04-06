<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;

use App\Models\section;


class CustomersReportController extends Controller
{
     public function index(){
        $sections=  section::all();

        return view('reports.customers',compact('sections'));




     }


     public function searchCustomers(Request $request){

        $startDate = date($request->startDate);
        $endDate = date($request->endDate);
        $section = $request->section;
        $product = $request->product;
        $sections = section::all();



        if($section && $product && $startDate =='' && $endDate == ''){
            $invoices= invoices::where('section_id',$section)
                               ->where('product',$product)
                               ->get();

            return view('reports.customers',compact('invoices','sections'));
        }else{

            $invoices = invoices::whereBetween('invoice_date',[$startDate,$endDate])
                                 ->where('section_id',$section)
                                 ->where('product',$product)
                                 ->get();

            return view('reports.customers')
                  ->with('invoices',$invoices)
                  ->with('startDate',$startDate)
                  ->with('endDate',$endDate)
                  ->with('sections',$sections);

        }

     }
}
