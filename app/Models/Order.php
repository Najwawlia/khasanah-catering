<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'user_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'event_date',
        'delivery_type',
        'shipping_address',
        'kecamatan',
        'latitude',
        'longitude',
        'special_notes',
        'payment_method',
        'payment_type',
        'total_amount',
        'dp_amount',
        'paid_amount',
        'payment_status',
        'tracking_status',
        'is_read_by_admin',
    ];

    protected $casts = [
        'event_date' => 'date',
        'total_amount' => 'decimal:2',
        'dp_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * True jika pesanan sudah lunas 100% (baik yang bayar penuh dari awal
     * maupun yang DP lalu sudah menyelesaikan pelunasan).
     */
    public function isFullyPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    /**
     * True jika pesanan ini pakai skema DP dan DP-nya sudah dibayar,
     * tapi pelunasan sisa 50% belum dilakukan customer.
     */
    public function needsSettlement(): bool
    {
        return $this->payment_type === 'dp_50' && $this->payment_status === 'dp_paid';
    }

    /**
     * Sisa tagihan yang wajib dilunasi customer.
     */
    public function getRemainingAmountAttribute()
    {
        return max($this->total_amount - $this->paid_amount, 0);
    }

    /**
     * Aturan bisnis: status tracking "ready" (Diantar ke Lokasi / Siap Diambil)
     * hanya boleh dipasang admin kalau pesanan sudah lunas 100%.
     * Dipakai di Admin\OrderController supaya aturan ini konsisten
     * di update_status maupun update_tracking (quick update papan/tabel).
     */
    public function canBeMarkedReady(): bool
    {
        return $this->isFullyPaid();
    }
}
