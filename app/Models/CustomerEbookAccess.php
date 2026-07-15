<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerEbookAccess extends Model
{
    protected $table = 'customer_ebook_access';

    protected $fillable = [
        'user_id',
        'ebook_id',
        'order_item_id',
        'granted_at',
        'revoked_at',
        'download_limit',
        'download_count',
        'last_downloaded_at',
    ];

    protected $casts = [
        'granted_at' => 'datetime',
        'revoked_at' => 'datetime',
        'last_downloaded_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function ebook()
    {
        return $this->belongsTo('App\Models\Ebook');
    }

    public function orderItem()
    {
        return $this->belongsTo('App\Models\OrderItem');
    }
}
