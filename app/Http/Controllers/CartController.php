<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['pax_quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'pax_quantity' => 'required|integer|min:1',
        ]);

        $pax = (int) $request->pax_quantity;
        $menu = Menu::findOrFail($request->menu_id);
        $isTumpeng = $menu->category === 'Custom / Tumpeng';

        // VALIDASI KHUSUS KATERING: MINIMAL 30 PACK (tidak berlaku untuk Custom/Tumpeng)
        if (!$isTumpeng && $pax < 30) {
            return back()->with('error_min_pax', 'Mohon maaf! Minimal pemesanan katering adalah 30 porsi (pack). Silakan masukkan 30 porsi atau lebih.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['pax_quantity'] += $pax;
        } else {
            $cart[$menu->id] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => (float) $menu->price_per_pax,
                'category' => $menu->category,
                'image' => $menu->image,
                'pax_quantity' => $pax,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Menu "' . $menu->name . '" (' . $pax . ' pax) berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pax_quantity' => 'required|integer|min:1',
        ]);

        $pax = (int) $request->pax_quantity;
        $cart = session()->get('cart', []);
        $isTumpeng = isset($cart[$id]) && $cart[$id]['category'] === 'Custom / Tumpeng';

        // VALIDASI KHUSUS KATERING: MINIMAL 30 PACK (tidak berlaku untuk Custom/Tumpeng)
        if (!$isTumpeng && $pax < 30) {
            return back()->with('error_min_pax', 'Gagal memperbarui: Jumlah porsi katering minimal 30 pack!');
        }

        if (isset($cart[$id])) {
            $cart[$id]['pax_quantity'] = $pax;
            session()->put('cart', $cart);
            return back()->with('success', 'Jumlah porsi katering berhasil diperbarui!');
        }

        return back()->with('error', 'Item menu tidak ditemukan di keranjang.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return back()->with('success', 'Item berhasil dihapus dari keranjang.');
        }

        return back()->with('error', 'Item tidak ditemukan.');
    }
}
