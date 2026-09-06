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
        //
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
            ['email' => 'aloksantoso@gmail.com'],
            [
                'name' => 'Alok',
                'phone' => '089876543210',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ]
        );

        // 2. Data Menu Katering
        $menus = [
            [
                
                'name' => 'Nasi Kotak Kuning Karakter Beruang',
                'category' => 'Nasi Kotak',
                'description' => 'Nasi kuning dicetak lucu bentuk beruang, cocok buat acara ulang tahun anak atau sekolah. Dilengkapi mie goreng, bakso, sambal goreng kentang hati, dan irisan timun segar.',
                'price_per_pax' => 40000,
                'min_pax' => 30,
                'image' => '0Xe62Cg0ySjqBSIHBqf1UNbsU1xh1t1ZGWejNhe3.jpg',
            ],
            [
                'name' => 'Snack Box Buah & Bolu Jeruk',
                'category' => 'Snack Box',
                'description' => 'Kombinasi buah jeruk segar, bolu jeruk lembut, dan lemper isi ayam. Pilihan pas buat coffee break atau seminar setengah hari.',
                'price_per_pax' => 20000,
                'min_pax' => 30,
                'image' => '3cx4RjFxgxedDWNPMGzYgfDz0RAQ5TCQyQWa9asL.jpg',
            ],
            [
                'name' => 'Tumpeng Kuning Deluxe Garnish Lengkap',
                'category' => 'Custom / Tumpeng',
                'description' => 'Tumpeng nasi kuning dengan hiasan ukiran sayur dan bunga yang cantik buat dipajang, dilengkapi ayam goreng, perkedel, orek tempe, dan mie goreng. Cocok buat acara syukuran atau kantor.',
                'price_per_pax' => 60000,
                'min_pax' => 30,
                'image' => '4fqgY6CWwaWbnMtKzxFYbB9Yifmoc1w03BrgHdhI.jpg',
            ],
            [
                'name' => 'Nasi Kotak Ayam & Sayur Oseng',
                'category' => 'Nasi Kotak',
                'description' => 'Nasi kotak praktis dengan ayam suwir bumbu, oseng sayur hijau, dan tempe, dibungkus rapi satu-satu buat acara rapat atau kondangan.',
                'price_per_pax' => 35000,
                'min_pax' => 30,
                'image' => 'B63unWqBmgX5RcYmLDxNvVVLutuGpJKrY6Udtd3f.jpg',
            ],
            [
                'name' => 'Tumpeng Putih Sayur Mentah & Lauk Lengkap',
                'category' => 'Custom / Tumpeng',
                'description' => 'Tumpeng nasi putih gurih dengan lalapan sayur mentah, tempe orek, telur pindang, ayam goreng, dan abon, disusun rapi di atas tampah anyaman. Cocok buat acara syukuran keluarga.',
                'price_per_pax' => 55000,
                'min_pax' => 30,
                'image' => 'C0x6oZGRHQg8nycs1eX6C7AwuU79JhHO7HgUttHn.jpg',
            ],
            [
                'name' => 'Nasi Kotak Tempe Bakar & Acar Kuning',
                'category' => 'Nasi Kotak',
                'description' => 'Tempe bakar gurih dipadukan sambal, oseng jamur kuping, dan acar kuning segar, lengkap dengan camilan renyah dalam satu kotak.',
                'price_per_pax' => 30000,
                'min_pax' => 30,
                'image' => 'DtNbsANTPDgtCBaCiwlVEJI81mHKMZQS0TsRBpBc.jpg',
            ],
            [
                'name' => 'Nasi Kotak Ayam Bumbu Kuning Premium',
                'category' => 'Nasi Kotak',
                'description' => 'Ayam bumbu kuning empuk dengan aroma rempah kuat, disandingkan tempe orek dan urap sayur segar. Kemasan rapi ala box premium.',
                'price_per_pax' => 42000,
                'min_pax' => 30,
                'image' => 'DvfhDtx3vq4CCFz3XKrAu8RKvCibW5onfs2YC9xo.jpg',
            ],
            [
                'name' => 'Nasi Kotak Ikan Bakar Sambal',
                'category' => 'Nasi Kotak',
                'description' => 'Ikan bakar berbalur sambal pedas, ditemani tempe orek dan kerupuk mie. Pilihan gurih buat yang suka menu seafood sederhana.',
                'price_per_pax' => 38000,
                'min_pax' => 30,
                'image' => 'GqI8zOFLdQ1yZl4khPhYU7uaQqVBEh9MEMxJuj18.jpg',
            ],
            [
                'name' => 'Nasi Kotak Gudeg Jogja Komplit',
                'category' => 'Nasi Kotak',
                'description' => 'Nasi dibungkus daun pisang khas gudeg, dilengkapi ayam suwir bumbu kuning, krecek pedas, telur pindang, sambal, dan kerupuk.',
                'price_per_pax' => 45000,
                'min_pax' => 30,
                'image' => 'KlkYI7dbh62qoQh6X0Kj8MzwfBA0unw3pyt1dk1h.jpg',
            ],
            [
                'name' => 'Nasi Kotak Ayam Kecap Paha Utuh',
                'category' => 'Nasi Kotak',
                'description' => 'Ayam paha utuh dimasak kecap manis mengilap, disajikan bersama mie goreng, acar, sambal goreng ati kentang, dan kerupuk udang.',
                'price_per_pax' => 42000,
                'min_pax' => 30,
                'image' => 'U0fmWbLvlfQKgVFfbKYkYLY3fyH14wqDpH9l67ep.jpg',
            ],
            [
                'name' => 'Tumpeng Putih Telur Pindang & Abon',
                'category' => 'Custom / Tumpeng',
                'description' => 'Tumpeng nasi putih klasik dengan telur pindang, ayam goreng, abon gurih, urap sayur, dan wortel, dihias ukiran lobak dan cabai berbentuk bunga.',
                'price_per_pax' => 58000,
                'min_pax' => 30,
                'image' => 'Y75B2SpxgPv015l8RR61UelG5dsDPlJHKmwkjYJ4.jpg',
            ],
            [
                'name' => 'Nasi Kotak Ayam Saus Madu Mustard',
                'category' => 'Nasi Kotak',
                'description' => 'Ayam crispy disiram saus madu mustard manis gurih, cocok buat acara yang tamunya suka menu kekinian.',
                'price_per_pax' => 33000,
                'min_pax' => 30,
                'image' => 'eEC5pRyCpBcA5KKZuHOkRrWOLOx5O9kLEsOvMxcF.jpg',
            ],
            [
                'name' => 'Nasi Kotak Ayam Suwir Sambal Simple',
                'category' => 'Nasi Kotak',
                'description' => 'Menu nasi kotak ekonomis: nasi putih, ayam suwir sambal, dan lalapan timun. Praktis dan pas buat konsumsi rapat harian dalam jumlah banyak.',
                'price_per_pax' => 25000,
                'min_pax' => 30,
                'image' => 'jLruD9Y9C0DAGc9CajRBdPm8NsyKuCMNrbgunXjA.jpg',
            ],
            [
                'name' => 'Nasi Kotak Gulai Daging Sapi',
                'category' => 'Nasi Kotak',
                'description' => 'Gulai daging sapi empuk berkuah kental, dilengkapi telur, cap cay sayur, acar, dan sambal goreng ati kentang. Menu istimewa buat acara spesial.',
                'price_per_pax' => 48000,
                'min_pax' => 30,
                'image' => 'rYXNDrhDpkUcxX4Vw0u48ljtwGu2z7IQzBo5iBjP.jpg',
            ],
            [
                'name' => 'Prasmanan Ayam Kari & Ayam Kemangi',
                'category' => 'Prasmanan',
                'description' => 'Paket prasmanan lengkap dengan chafing dish: nasi putih, kari ayam gurih, ayam kemangi pedas manis, dan sambal segar. Disajikan hangat langsung di lokasi acara.',
                'price_per_pax' => 70000,
                'min_pax' => 30,
                'image' => 'reo40YpKfjIE2XLr0CGFIrVfikl9r175rsbL5PMm.jpg',
            ],
            [
                'name' => 'Snack Box Dessert Tart Buah & Cupcake',
                'category' => 'Snack Box',
                'description' => 'Snack manis berisi tart buah segar, cupcake lembut, dan puding warna-warni. Cocok jadi penutup di acara arisan atau ulang tahun kantor.',
                'price_per_pax' => 22000,
                'min_pax' => 30,
                'image' => 'yqrTPQgmt2l9wZyzUH934Kf0OIY4S1LO81vAgbAo.jpg',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
