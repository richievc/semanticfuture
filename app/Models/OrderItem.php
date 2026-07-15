<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'ebook_id',
        'product_title_snapshot',
        'unit_price_snapshot',
        'quantity',
        'line_total',
    ];

    protected $casts = [
        'unit_price_snapshot' => 'decimal:2',
        'line_total' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function ebook()
    {
        return $this->belongsTo('App\Models\Ebook');
    }

    public function access()
    {
        return $this->hasOne('App\Models\CustomerEbookAccess');
    }
}
