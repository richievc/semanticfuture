<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'cover_image',
        'price',
        'currency',
        'file_path',
        'is_published',
        'max_downloads',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_published' => 'boolean',
        'max_downloads' => 'integer',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function customerAccess()
    {
        return $this->hasMany('App\Models\CustomerEbookAccess');
    }

    public function productEvents()
    {
        return $this->hasMany('App\Models\ProductEvent');
    }

    public function coverUrl(): ?string
    {
        return $this->cover_image ? \Illuminate\Support\Facades\Storage::disk('public')->url($this->cover_image) : null;
    }
}
