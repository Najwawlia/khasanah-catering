<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenus = Menu::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $ordersToday = Order::whereDate('created_at', Carbon::today())->count();
        $revenueThisMonth = Order::whereIn('payment_status', ['dp_paid', 'paid'])
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('paid_amount');

        $pendingOrders = Order::where('payment_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentOrders = Order::with('items')->orderBy('created_at', 'desc')->take(5)->get();

        // --- Grafik penjualan 7 hari terakhir ---
        $salesChartLabels = [];
        $salesChartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $salesChartLabels[] = $date->format('d M');
            $salesChartData[] = (float) Order::whereDate('created_at', $date)
                ->whereIn('payment_status', ['dp_paid', 'paid'])
                ->sum('total_amount');
        }

        // --- Distribusi menu per kategori ---
        $categoryDistribution = Menu::selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        return view('admin.dashboard', compact(
            'totalMenus',
            'totalCustomers',
            'ordersToday',
            'revenueThisMonth',
            'pendingOrders',
            'recentOrders',
            'salesChartLabels',
            'salesChartData',
            'categoryDistribution'
        ));
    }
}
