<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Support\SemarangArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $minEventDate = now()->addDays(3)->format('Y-m-d');
        $kecamatanList = SemarangArea::KECAMATAN;
        $mapCenter = SemarangArea::CENTER;

        return view('checkout.index', compact('cart', 'totalAmount', 'dp50Amount', 'user', 'minEventDate', 'kecamatanList', 'mapCenter'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }

        $minEventDate = now()->addDays(3)->startOfDay();

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:255',
            'event_date' => 'required|date|after_or_equal:' . $minEventDate->format('Y-m-d'),
            'delivery_type' => 'required|in:pickup,delivery',
            'shipping_address' => 'required_if:delivery_type,delivery|nullable|string',
            'kecamatan' => 'required_if:delivery_type,delivery|nullable|in:' . implode(',', SemarangArea::KECAMATAN),
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'special_notes' => 'nullable|string',
            'payment_method' => 'required|in:qris',
            'payment_type' => 'required|in:full,dp_50',
        ], [
            'customer_name.required' => 'Nama lengkap pemesan wajib diisi.',
            'customer_phone.required' => 'Nomor Telepon/WhatsApp wajib diisi.',
            'customer_email.required' => 'Alamat Email wajib diisi.',
            'event_date.required' => 'Tanggal acara wajib dipilih!',
            'event_date.after_or_equal' => 'Mohon maaf, pemesanan katering minimal 3 hari sebelum tanggal acara (tidak melayani pesanan mendadak/dadakan).',
            'shipping_address.required_if' => 'Alamat pengiriman lokasi acara wajib diisi untuk layanan Delivery.',
            'kecamatan.required_if' => 'Pilih kecamatan lokasi acara. Kami saat ini hanya melayani pengiriman di wilayah Kota Semarang.',
            'kecamatan.in' => 'Kecamatan yang dipilih tidak valid. Kami saat ini hanya melayani pengiriman di wilayah Kota Semarang.',
            'payment_method.required' => 'Pilih salah satu metode pembayaran.',
            'payment_type.required' => 'Pilih jenis pembayaran (Bayar Penuh atau DP 50%).',
        ]);

        // Lapisan validasi kedua: kalau customer sempat menggeser pin di peta
        // sampai keluar wilayah Kota Semarang, tolak juga di sini.
        $validator->after(function ($validator) use ($request) {
            if ($request->delivery_type === 'delivery' && $request->filled('latitude') && $request->filled('longitude')) {
                $inBounds = SemarangArea::isWithinBounds((float) $request->latitude, (float) $request->longitude);
                if (!$inBounds) {
                    $validator->errors()->add(
                        'shipping_address',
                        'Titik lokasi yang Anda pilih di peta berada di luar wilayah Kota Semarang. Kami saat ini hanya melayani pengiriman di dalam Kota Semarang — silakan sesuaikan pin-nya, atau pilih Pickup kalau lokasi acara di luar Semarang.'
                    );
                }
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

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
            'kecamatan' => $request->delivery_type === 'delivery' ? $request->kecamatan : null,
            'latitude' => $request->delivery_type === 'delivery' ? $request->latitude : null,
            'longitude' => $request->delivery_type === 'delivery' ? $request->longitude : null,
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
