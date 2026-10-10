<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorFaq extends Model
{
    protected $fillable = [
        'doctor_profile_id',
        'question',
        'answer',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function doctorProfile(): BelongsTo
    {
        return $this->belongsTo(DoctorProfile::class);
    }
}
