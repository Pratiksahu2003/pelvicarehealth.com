<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PatientProfile extends Model
{
    protected $fillable = [
        'user_id',
        'medical_history',
        'allergies',
        'current_medications',
        'emergency_contact_name',
        'emergency_contact_phone',
        'address',
        'city',
        'state',
        'pincode',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(PatientDocument::class, 'patient_id', 'user_id');
    }
}

