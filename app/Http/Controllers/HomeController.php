<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Charts\InvoicesChart;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $sumInvoices = invoices::sum('total');
        $countInvoices=invoices::count();

        $sumUnpaid= invoices::where('value_status',2)->sum('total');
        $countUnpaid= invoices::where('value_status',2)->count();
        $percentageUnpaid=round(($countUnpaid/$countInvoices)*100);


        $sumPaid= invoices::where('value_status',1)->sum('total');
        $countPaid= invoices::where('value_status',1)->count();
        $percentagePaid=round(($countPaid/$countInvoices)*100);


        $sumPartial= invoices::where('value_status',3)->sum('total');
        $countPartial= invoices::where('value_status',3)->count();
        $percentagePartial=round(($countPartial/$countInvoices)*100);

        $pieChart = InvoicesChart::pieChart();
        $barChart = InvoicesChart::barChart();


        return view('home', compact('sumInvoices',
                                              'countInvoices',
                                                         'sumUnpaid',
                                                         'countUnpaid',
                                                         'percentageUnpaid',
                                                         'sumPaid',
                                                         'countPaid',
                                                         'percentagePaid',
                                                         'sumPartial',
                                                         'countPartial',
                                                        'percentagePartial',
                                                        'pieChart',
                                                        'barChart'));
    }
}

