<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    protected $fillable = [
        'type',
        'slug',
        'title',
        'content',
        'meta_title',
        'meta_description',
        'is_published',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

