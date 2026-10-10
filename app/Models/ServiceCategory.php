<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'image',
        'card_color',
        'sort_order',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'backend_tags',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'backend_tags' => 'array',
    ];

    public function subcategories(): HasMany
    {
        return $this->hasMany(ServiceSubcategory::class, 'service_category_id')->orderBy('sort_order');
    }

    public function activeSubcategories(): HasMany
    {
        return $this->hasMany(ServiceSubcategory::class, 'service_category_id')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
