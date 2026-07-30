<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenus = Menu::count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('payment_status', 'pending')->count();
        $totalRevenue = Order::whereIn('payment_status', ['dp_paid', 'paid'])->sum('paid_amount');
        $recentOrders = Order::with('items')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalMenus', 'totalOrders', 'pendingOrders', 'totalRevenue', 'recentOrders'));
    }
}
