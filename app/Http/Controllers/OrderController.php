<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function paymentPage($order_code)
    {
        $order = Order::with('items')->where('order_code', $order_code)->firstOrFail();
        return view('order.payment', compact('order'));
    }

    public function confirmPayment(Request $request, $order_code)
    {
        $order = Order::where('order_code', $order_code)->firstOrFail();

        $amountToPay = ($order->payment_type === 'dp_50') ? $order->dp_amount : $order->total_amount;
        $order->paid_amount = $amountToPay;
        $order->payment_status = ($order->payment_type === 'dp_50') ? 'dp_paid' : 'paid';
        $order->tracking_status = 'payment_verified';
        $order->save();

        return redirect()->route('order.tracking', $order->order_code)->with('success', 'Pembayaran berhasil diverifikasi! Tanggal acara Anda telah resmi kami amankan.');
    }

    public function trackingPage($order_code)
    {
        $order = Order::with('items')->where('order_code', $order_code)->firstOrFail();
        return view('order.tracking', compact('order'));
    }

    public function myOrders()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat pesanan Anda.');
        }

        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('order.my_orders', compact('orders'));
    }
}
