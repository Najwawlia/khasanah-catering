<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('Paket Prasmanan'); // e.g. Prasmanan, Nasi Kotak, Snack Box, Custom
            $table->text('description');
            $table->decimal('price_per_pax', 12, 2);
            $table->integer('min_pax')->default(30); // Minimal pemesanan 30 pax
            $table->string('image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
