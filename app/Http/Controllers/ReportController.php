<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function sales(Request $request) {
        $start_date = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $end_date = $request->get('end_date', Carbon::now()->format('Y-m-d'));

        $sales = Order::with(['customer', 'payment'])
            ->where('payment_status', 'paid')
            ->whereBetween('order_date', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
            ->latest()
            ->get();

        $total_revenue = $sales->sum('total_price');

        return view('admin.pages.reports.sales', compact('sales', 'total_revenue', 'start_date', 'end_date'));
    }
}