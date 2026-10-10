<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorPhoto extends Model
{
    protected $fillable = [
        'doctor_profile_id',
        'path',
        'type',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public const TYPE_GALLERY = 'gallery';
    public const TYPE_CLINIC = 'clinic';

    public function doctorProfile(): BelongsTo
    {
        return $this->belongsTo(DoctorProfile::class);
    }
}
