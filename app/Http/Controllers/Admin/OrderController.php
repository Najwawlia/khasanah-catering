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

        $orders = $query->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items', 'user'])->findOrFail($id);

        // Begitu admin membuka detail pesanan, otomatis dianggap "sudah dibaca".
        if (!$order->is_read_by_admin) {
            $order->update(['is_read_by_admin' => true]);
        }

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Dipanggil via fetch() dari topbar admin (polling) untuk mengisi
     * badge & daftar lonceng notifikasi "Pesanan Baru".
     */
    public function notifications()
    {
        $unreadCount = Order::where('is_read_by_admin', false)->count();

        $unreadOrders = Order::where('is_read_by_admin', false)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_code' => $order->order_code,
                    'customer_name' => $order->customer_name,
                    'total_amount' => 'Rp ' . number_format($order->total_amount, 0, ',', '.'),
                    'payment_type' => $order->payment_type === 'dp_50' ? 'DP 50%' : 'Bayar Penuh',
                    'time_ago' => $order->created_at->diffForHumans(),
                    'url' => route('admin.orders.show', $order->id),
                ];
            });

        return response()->json([
            'count' => $unreadCount,
            'orders' => $unreadOrders,
        ]);
    }

    /**
     * Tandai semua pesanan baru sebagai sudah dibaca (tombol "Tandai semua dibaca").
     */
    public function markAllNotificationsRead()
    {
        Order::where('is_read_by_admin', false)->update(['is_read_by_admin' => true]);

        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'payment_status' => 'required|in:pending,dp_paid,paid,cancelled',
            'tracking_status' => 'required|in:booking_received,payment_verified,kitchen_prep,ready',
        ]);

        // Cek dulu berdasarkan payment_status BARU yang mau disimpan (bukan yang lama),
        // karena admin bisa saja mengubah keduanya sekaligus dalam satu submit.
        if ($request->tracking_status === 'ready' && $request->payment_status !== 'paid') {
            return back()->with('error', 'Status "Pesanan Siap" tidak bisa dipilih karena pesanan ' . $order->order_code . ' pakai DP dan belum dilunasi customer. Sisa tagihan: Rp ' . number_format($order->remaining_amount, 0, ',', '.') . '.');
        }

        $order->payment_status = $request->payment_status;
        $order->tracking_status = $request->tracking_status;

        // Auto update paid_amount jika admin mengubah status ke 'paid'
        if ($request->payment_status === 'paid') {
            $order->paid_amount = $order->total_amount;
        } elseif ($request->payment_status === 'dp_paid' && $order->dp_amount > 0) {
            $order->paid_amount = $order->dp_amount;
        }

        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Update HANYA tracking_status (timeline proses dapur) tanpa mengubah payment_status.
     * Dipakai untuk update cepat langsung dari Dashboard / daftar Pesanan.
     */
    public function updateTracking(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'tracking_status' => 'required|in:booking_received,payment_verified,kitchen_prep,ready',
        ]);

        // Blokir kalau mau ditandai "ready" tapi pesanan (khususnya yang DP) belum lunas.
        if ($request->tracking_status === 'ready' && !$order->canBeMarkedReady()) {
            return back()->with('error', 'Pesanan ' . $order->order_code . ' belum bisa ditandai "Siap" karena masih ada sisa tagihan DP sebesar Rp ' . number_format($order->remaining_amount, 0, ',', '.') . ' yang belum dilunasi customer.');
        }

        $order->tracking_status = $request->tracking_status;
        $order->save();

        return back()->with('success', 'Timeline pesanan ' . $order->order_code . ' berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Data pesanan berhasil dihapus!');
    }
}
