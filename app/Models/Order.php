<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $guarded = [];

    protected $casts = [
        'shipping_address' => 'array',
        'subtotal' => 'decimal:3',
        'shipping' => 'decimal:3',
        'total' => 'decimal:3',
    ];

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->order_number ??= 'AZ'.now()->format('ymd').strtoupper(Str::random(4));
        });
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
