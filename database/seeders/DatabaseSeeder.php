<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin & Customer Dummy
        User::updateOrCreate(
            ['email' => 'admin@khacate.com'],
            [
                'name' => 'Chef Admin KhaCate',
                'phone' => '081234567890',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@khacate.com'],
            [
                'name' => 'Budi Santoso',
                'phone' => '089876543210',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ]
        );

        // 2. Data Dummy Menu Katering Premium
        $menus = [
            [
                'name' => 'Paket Sultan Royal Buffet',
                'category' => 'Prasmanan',
                'description' => 'Menu prasmanan mewah kelas bintang lima: Nasi Wagyu Olahan, Ayam Grill Sauce Mushroom, Daging Beef Teriyaki, Sup Cream Asparagus, Dessert Parfait & Ice Cream, Infused Water & Fruit Punch.',
                'price_per_pax' => 85000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1555244162-803834f70033?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
            [
                'name' => 'Nusantara Heritage Wedding',
                'category' => 'Prasmanan',
                'description' => 'Hidangan Nusantara legendaris: Nasi Liwet Rempah, Rendang Sapi Grand Master, Ayam Bakar Taliwang, Es Teler Special, Karedok Fresh & Sambal 3 Varian.',
                'price_per_pax' => 65000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
            [
                'name' => 'Executive Corporate Box',
                'category' => 'Nasi Kotak',
                'description' => 'Paket nasi kotak eksklusif rapat & konferensi: Nasi Pandan wangi, Chicken Steak Blackpepper, Udang Goreng Tepung, Capcay Seafood, Buah Segar & Pudding.',
                'price_per_pax' => 45000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1626777552726-4a6b54c97e46?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
            [
                'name' => 'Deluxe Coffee Break & Snack Box',
                'category' => 'Snack Box',
                'description' => 'Paket cemilan premium: Pastry Croissant Almond, Risoles Smoked Beef Mayo, Slice Cake Red Velvet, Mineral Water, & Premium Bottled Milk Tea.',
                'price_per_pax' => 25000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
            [
                'name' => 'Tumpeng Agung Nusantara (100 Pax)',
                'category' => 'Custom / Tumpeng',
                'description' => 'Tumpeng Kuning Megah untuk Peresmian & Acara Syukuran: Ayam Goreng Lengkuas, Perkedel, Sambal Goreng Ati Ampela, Telur Balado, Ababon Daging, Kering Tempe.',
                'price_per_pax' => 50000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
            [
                'name' => 'Gourmet Grill & Live BBQ Station',
                'category' => 'Prasmanan',
                'description' => 'Live Cooking BBQ Station di lokasi acara: Premium Ribeye Steak, Chicken Wings Honey Mustard, Roasted Potatoes, Grilled Corn, Mushroom & BBQ Sauce.',
                'price_per_pax' => 95000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1529193591184-b1d58069ecdd?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
