<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorDocument extends Model
{
    protected $fillable = [
        'doctor_id',
        'document_type',
        'file_path',
        'file_name',
        'status',
        'rejection_reason',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}

