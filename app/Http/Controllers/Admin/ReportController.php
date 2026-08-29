<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Omset per bulan (6 bulan terakhir)
        $monthlyRevenue = Order::whereIn('payment_status', ['dp_paid', 'paid'])
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(paid_amount) as total")
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(6)
            ->get()
            ->reverse();

        // Menu paling laris (berdasarkan total pax terjual)
        $topMenus = OrderItem::selectRaw('menu_name, SUM(pax_quantity) as total_pax, SUM(subtotal) as total_omset')
            ->groupBy('menu_name')
            ->orderBy('total_pax', 'desc')
            ->take(5)
            ->get();

        $totalRevenueAllTime = Order::whereIn('payment_status', ['dp_paid', 'paid'])->sum('paid_amount');
        $totalOrdersAllTime = Order::count();
        $avgOrderValue = $totalOrdersAllTime > 0 ? Order::avg('total_amount') : 0;

        return view('admin.reports.index', compact('monthlyRevenue', 'topMenus', 'totalRevenueAllTime', 'totalOrdersAllTime', 'avgOrderValue'));
    }
}
