<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        $menus = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'price_per_pax' => 'required|numeric|min:0',
            'min_pax' => 'required|integer|min:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'Nama menu wajib diisi.',
            'category.required' => 'Kategori menu wajib diisi.',
            'description.required' => 'Deskripsi menu wajib diisi.',
            'price_per_pax.required' => 'Harga per pax wajib diisi.',
            'min_pax.min' => 'Minimal pemesanan untuk katering tidak boleh kurang dari 30 pax.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $imagePath = 'https://images.unsplash.com/photo-1555244162-803834f70033?w=800&auto=format&fit=crop&q=80';

        if ($request->hasFile('image')) {
            $imagePath = asset('storage/' . $request->file('image')->store('menus', 'public'));
        }

        Menu::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price_per_pax' => $request->price_per_pax,
            'min_pax' => $request->min_pax,
            'image' => $imagePath,
            'is_available' => $request->has('is_available') ? true : false,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu katering baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'price_per_pax' => 'required|numeric|min:0',
            'min_pax' => 'required|integer|min:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $imagePath = $menu->image;

        if ($request->hasFile('image')) {
            // Hapus foto lama jika itu file lokal hasil upload (bukan link eksternal/default)
            if ($menu->image && str_contains($menu->image, '/storage/menus/')) {
                $oldRelativePath = 'menus/' . basename($menu->image);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldRelativePath);
            }

            $imagePath = asset('storage/' . $request->file('image')->store('menus', 'public'));
        }

        $menu->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price_per_pax' => $request->price_per_pax,
            'min_pax' => $request->min_pax,
            'image' => $imagePath,
            'is_available' => $request->has('is_available') ? true : false,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Data menu katering berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu katering berhasil dihapus!');
    }
}
