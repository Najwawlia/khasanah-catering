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
            ['email' => 'admin123@gmail.com'],
            [
                'name' => 'Admin',
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

        // 2. Data Dummy Menu Katering
        $menus = [
            [
                'name' => 'Prasmanan Nasi Kebuli & Ayam Panggang Madu',
                'category' => 'Prasmanan',
                'description' => 'Nasi kebuli rempah yang dimasak pelan-pelan biar bumbunya benar-benar meresap, dipadukan ayam panggang madu, sup krim jagung hangat, dan es buah segar buat penutup. Favorit buat resepsi dan acara kantor yang tamunya banyak.',
                'price_per_pax' => 85000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1555244162-803834f70033?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
            [
                'name' => 'Prasmanan Rendang & Nasi Liwet Nusantara',
                'category' => 'Prasmanan',
                'description' => 'Rendang dimasak minimal 4 jam sampai bumbunya nempel sempurna di daging, disandingkan nasi liwet gurih, ayam bakar taliwang, karedok segar, dan sambal 3 level buat yang doyan pedas.',
                'price_per_pax' => 65000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
            [
                'name' => 'Nasi Kotak Rapat & Meeting Kantor',
                'category' => 'Nasi Kotak',
                'description' => 'Nasi kotak rapi buat rapat kantor — ada chicken steak lada hitam, udang goreng crispy, capcay seafood, plus buah potong segar. Dikemas satu-satu, gampang dibagikan ke tim tanpa ribet.',
                'price_per_pax' => 45000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1626777552726-4a6b54c97e46?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
            [
                'name' => 'Snack Box Coffee Break',
                'category' => 'Snack Box',
                'description' => 'Cocok buat jeda rapat atau seminar setengah hari — risoles isi smoked beef, cake red velvet potong, air mineral, dan susu kemasan. Sederhana tapi tetap bikin kenyang sampai sesi berikutnya.',
                'price_per_pax' => 25000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
            [
                'name' => 'Tumpeng Kuning Syukuran',
                'category' => 'Custom / Tumpeng',
                'description' => 'Tumpeng kuning lengkap buat syukuran, peresmian, atau rumah baru — ayam goreng lengkuas, perkedel, sambal goreng ati ampela, telur balado, dan kering tempe. Porsi bisa disesuaikan, gak harus pesan yang besar.',
                'price_per_pax' => 50000,
                'min_pax' => 30,
                'image' => 'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?w=800&auto=format&fit=crop&q=80',
                'is_available' => true,
            ],
            [
                'name' => 'Live BBQ Station di Lokasi Acara',
                'category' => 'Prasmanan',
                'description' => 'Tim kami masak langsung di tempat acara — ribeye steak, sayap ayam honey mustard, kentang panggang, dan jagung bakar mentega. Cocok buat acara outdoor, garden party, atau acara ulang tahun yang santai.',
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
