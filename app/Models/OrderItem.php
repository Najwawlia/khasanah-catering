<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'menu_name',
        'price_per_pax',
        'pax_quantity',
        'subtotal',
    ];

    protected $casts = [
        'price_per_pax' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'pax_quantity' => 'integer',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
