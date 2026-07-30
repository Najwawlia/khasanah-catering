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
        'special_notes',
        'payment_method',
        'payment_type',
        'total_amount',
        'dp_amount',
        'paid_amount',
        'payment_status',
        'tracking_status',
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
}
