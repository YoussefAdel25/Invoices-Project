<?php

namespace App\Charts;

use App\Models\invoices;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class InvoicesChart
{
    public static function pieChart()
    {
        $unpaid = invoices::where('value_status', 2)->count();
        $paid = invoices::where('value_status', 1)->count();
        $partial = invoices::where('value_status', 3)->count();
        $total = $unpaid + $paid + $partial ?: 1; // عشان ميحصلش قسمة على صفر

        $data = [
            round(($unpaid / $total) * 100, 2),
            round(($paid / $total) * 100, 2),
            round(($partial / $total) * 100, 2),
        ];

        $chart = new Chart;
        $chart->labels(['غير مدفوعة', 'مدفوعة', 'مدفوعة جزئياً']);
        $chart->dataset('الفواتير', 'pie', $data)
            ->backgroundColor(['#c0392b', '#388e3c', '#ff9642']);

        return $chart;
    }
    public static function barChart()
    {
        $unpaid = invoices::where('value_status', 2)->count();
        $paid = invoices::where('value_status', 1)->count();
        $partial = invoices::where('value_status', 3)->count();
        $total = $unpaid + $paid + $partial ?: 1;

        $chart = new Chart;
        $chart->labels(['الفواتير']);

        $chart->dataset('غير مدفوعة', 'bar', [round(($unpaid / $total) * 100, 2)])
            ->backgroundColor('#c0392b');

        $chart->dataset('مدفوعة', 'bar', [round(($paid / $total) * 100, 2)])
            ->backgroundColor('#388e3c');

        $chart->dataset('مدفوعة جزئياً', 'bar', [round(($partial / $total) * 100, 2)])
            ->backgroundColor('#ff9642');

        return $chart;
    }
}
