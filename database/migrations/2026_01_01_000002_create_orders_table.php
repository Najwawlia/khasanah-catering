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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email');
            $table->date('event_date');
            $table->enum('delivery_type', ['pickup', 'delivery'])->default('delivery');
            $table->text('shipping_address')->nullable();
            $table->text('special_notes')->nullable(); // Dietary notes / Catatan khusus
            $table->string('payment_method'); // qris, gopay, ovo, bca, mandiri, bri
            $table->enum('payment_type', ['full', 'dp_50'])->default('full'); // DP 50% atau Bayar Penuh
            $table->decimal('total_amount', 12, 2);
            $table->decimal('dp_amount', 12, 2)->default(0);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->enum('payment_status', ['pending', 'dp_paid', 'paid', 'cancelled'])->default('pending');
            $table->enum('tracking_status', ['booking_received', 'payment_verified', 'kitchen_prep', 'ready'])->default('booking_received');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
