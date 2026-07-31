<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::where('is_available', true);

        if ($request->has('category') && $request->category != 'All') {
            $query->where('category', $request->category);
        }

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $isDefaultView = (!$request->filled('category') || $request->category == 'All') && !$request->filled('search');

        if ($isDefaultView) {
            // Tampilkan 6 menu bestseller dulu, sisanya bisa dibuka lewat "Lihat Menu Lainnya"
            $bestsellers = (clone $query)->where('is_bestseller', true)->orderBy('created_at', 'desc')->take(6)->get();
            $others = (clone $query)->whereNotIn('id', $bestsellers->pluck('id'))->orderBy('created_at', 'desc')->get();
            $menus = $bestsellers->concat($others)->values();
            $bestsellerCount = $bestsellers->count();
        } else {
            $menus = $query->orderBy('created_at', 'desc')->get();
            $bestsellerCount = null; // null artinya: tampilkan semua, tanpa tombol "Lihat Menu Lainnya"
        }

        $categories = Menu::select('category')->distinct()->pluck('category');

        return view('home', compact('menus', 'categories', 'bestsellerCount'));
    }

    public function showMenu($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }
}
