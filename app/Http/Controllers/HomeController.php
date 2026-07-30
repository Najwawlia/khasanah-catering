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

        $menus = $query->get();
        $categories = Menu::select('category')->distinct()->pluck('category');

        return view('home', compact('menus', 'categories'));
    }

    public function showMenu($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }
}
