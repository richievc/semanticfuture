<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentEvent extends Model
{
    protected $fillable = [
        'payment_provider',
        'provider_event_id',
        'event_type',
        'related_order_id',
        'processing_status',
        'payload',
        'processed_at',
        'failure_message',
    ];

    protected $casts = [
        'payload' => 'array',
        'processed_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'related_order_id');
    }
}
