<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Kecamatan wajib diisi dari daftar resmi Kota Semarang (dropdown, bukan teks bebas)
            // supaya order dari luar Semarang tidak bisa lolos.
            $table->string('kecamatan')->nullable()->after('shipping_address');

            // Titik koordinat hasil pin di Google Maps (opsional, memudahkan kurir).
            $table->decimal('latitude', 10, 7)->nullable()->after('kecamatan');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['kecamatan', 'latitude', 'longitude']);
        });
    }
};
