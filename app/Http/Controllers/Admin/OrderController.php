<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('order_code', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('tracking_status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'payment_status' => 'required|in:pending,dp_paid,paid,cancelled',
            'tracking_status' => 'required|in:booking_received,payment_verified,kitchen_prep,ready',
        ]);

        $order->payment_status = $request->payment_status;
        $order->tracking_status = $request->tracking_status;

        // Auto update paid_amount jika admin mengubah status ke 'paid'
        if ($request->payment_status === 'paid') {
            $order->paid_amount = $order->total_amount;
        } elseif ($request->payment_status === 'dp_paid' && $order->dp_amount > 0) {
            $order->paid_amount = $order->dp_amount;
        }

        $order->save();

        return back()->with('success', 'Status pesanan &' . $order->order_code . ' berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Data pesanan berhasil dihapus!');
    }
}
