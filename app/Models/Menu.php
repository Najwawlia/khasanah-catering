<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'price_per_pax',
        'min_pax',
        'image',
        'is_available',
    ];

    protected $casts = [
        'price_per_pax' => 'decimal:2',
        'min_pax' => 'integer',
        'is_available' => 'boolean',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
