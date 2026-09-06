<?php

namespace App\Support;

class SemarangArea
{
    /**
     * 16 kecamatan resmi di Kota Semarang. Sengaja dibatasi jadi dropdown
     * (bukan input teks bebas) supaya alamat di luar Kota Semarang
     * tidak mungkin lolos lewat form checkout.
     */
    public const KECAMATAN = [
        'Semarang Tengah',
        'Semarang Utara',
        'Semarang Timur',
        'Semarang Selatan',
        'Semarang Barat',
        'Gayamsari',
        'Genuk',
        'Pedurungan',
        'Candisari',
        'Gajahmungkur',
        'Tembalang',
        'Banyumanik',
        'Gunungpati',
        'Ngaliyan',
        'Mijen',
        'Tugu',
    ];

    /**
     * Bounding box kasar wilayah Kota Semarang. Dipakai sebagai lapisan
     * validasi kedua untuk titik koordinat dari Google Maps picker,
     * jaga-jaga kalau ada yang menggeser pin sampai keluar Semarang.
     */
    public const BOUNDS = [
        'north' => -6.90,
        'south' => -7.15,
        'east' => 110.52,
        'west' => 110.28,
    ];

    public const CENTER = [
        'lat' => -6.9932,
        'lng' => 110.4203,
    ];

    public static function isWithinBounds(float $lat, float $lng): bool
    {
        return $lat <= self::BOUNDS['north']
            && $lat >= self::BOUNDS['south']
            && $lng >= self::BOUNDS['west']
            && $lng <= self::BOUNDS['east'];
    }
}
