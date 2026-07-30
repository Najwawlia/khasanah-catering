<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Keranjang Anda masih kosong. Silakan pilih menu katering terlebih dahulu!');
        }

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['pax_quantity'];
        }

        $dp50Amount = $totalAmount * 0.50;
        $user = Auth::user();

        return view('checkout.index', compact('cart', 'totalAmount', 'dp50Amount', 'user'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'delivery_type' => 'required|in:pickup,delivery',
            'shipping_address' => 'required_if:delivery_type,delivery|nullable|string',
            'special_notes' => 'nullable|string',
            'payment_method' => 'required|in:qris,gopay,ovo,bca,mandiri,bri',
            'payment_type' => 'required|in:full,dp_50',
        ], [
            'customer_name.required' => 'Nama lengkap pemesan wajib diisi.',
            'customer_phone.required' => 'Nomor Telepon/WhatsApp wajib diisi.',
            'customer_email.required' => 'Alamat Email wajib diisi.',
            'event_date.required' => 'Tanggal acara wajib dipilih!',
            'event_date.after_or_equal' => 'Tanggal acara tidak boleh tanggal di masa lalu.',
            'shipping_address.required_if' => 'Alamat pengiriman lokasi acara wajib diisi untuk layanan Delivery.',
            'payment_method.required' => 'Pilih salah satu metode pembayaran.',
            'payment_type.required' => 'Pilih jenis pembayaran (Bayar Penuh atau DP 50%).',
        ]);

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['pax_quantity'];
        }

        $dpAmount = ($request->payment_type === 'dp_50') ? ($totalAmount * 0.50) : 0;
        $paidAmount = 0; // belum dibayar sampai konfirmasi di halaman pembayaran

        // Kode unik order (contoh: KHA-20260729-A1B2)
        $orderCode = 'KHA-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $order = Order::create([
            'order_code' => $orderCode,
            'user_id' => Auth::check() ? Auth::id() : null,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'event_date' => $request->event_date,
            'delivery_type' => $request->delivery_type,
            'shipping_address' => $request->shipping_address,
            'special_notes' => $request->special_notes,
            'payment_method' => $request->payment_method,
            'payment_type' => $request->payment_type,
            'total_amount' => $totalAmount,
            'dp_amount' => $dpAmount,
            'paid_amount' => $paidAmount,
            'payment_status' => 'pending',
            'tracking_status' => 'booking_received',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['id'],
                'menu_name' => $item['name'],
                'price_per_pax' => $item['price'],
                'pax_quantity' => $item['pax_quantity'],
                'subtotal' => $item['price'] * $item['pax_quantity'],
            ]);
        }

        // Hapus keranjang setelah checkout sukses
        session()->forget('cart');

        return redirect()->route('order.payment', $order->order_code)->with('success', 'Pemesanan katering Anda berhasil dibuat! Silakan selesaikan pembayaran.');
    }
}
