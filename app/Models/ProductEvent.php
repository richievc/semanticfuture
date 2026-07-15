<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductEvent extends Model
{
    public const VIEWED = 'product_page_viewed';

    public const CHECKOUT_STARTED = 'checkout_started';

    public const PURCHASE_COMPLETED = 'purchase_completed';

    public const PURCHASE_FAILED = 'purchase_failed';

    public const DOWNLOAD_LINK_GENERATED = 'download_link_generated';

    public const DOWNLOAD_COMPLETED = 'download_completed';

    public const DOWNLOAD_REPEATED = 'download_repeated';

    public $timestamps = false;

    protected $fillable = [
        'event_type',
        'ebook_id',
        'user_id',
        'order_id',
        'customer_ebook_access_id',
        'session_id',
        'ip_address',
        'meta',
        'created_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'created_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (ProductEvent $event) {
            $event->created_at ??= now();
        });
    }

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Convenience logger used throughout the storefront/checkout/download
     * flow. Deliberately takes only IDs + a small meta array — never raw
     * payment payloads — so this table stays safe to display in the admin
     * analytics screens without redaction.
     */
    public static function log(string $type, array $attributes = []): self
    {
        return static::create(array_merge([
            'event_type' => $type,
            'session_id' => request()?->session()?->getId(),
            'ip_address' => request()?->ip(),
        ], $attributes));
    }
}
