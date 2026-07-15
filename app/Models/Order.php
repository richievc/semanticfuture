<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'subtotal',
        'total',
        'currency',
        'payment_provider',
        'paypal_order_id',
        'paypal_capture_id',
        'paid_at',
        'refunded_at',
        'failure_reason',
        'metadata',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
        'refunded_at' => 'datetime',
        'metadata' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function paymentEvents()
    {
        return $this->hasMany('App\Models\PaymentEvent', 'related_order_id');
    }

    public function productEvents()
    {
        return $this->hasMany('App\Models\ProductEvent');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }
}
