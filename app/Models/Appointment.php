<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'session_type',
        'session_fee',
        'patient_address',
        'status',
        'reason',
        'notes',
        'doctor_notes',
        'guest_name',
        'guest_phone',
        'guest_email',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'session_fee'      => 'decimal:2',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function slot(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AppointmentSlot::class);
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    /**
     * Returns patient display name (logged-in or guest).
     */
    public function getPatientNameAttribute(): string
    {
        if ($this->patient) {
            return $this->patient->name;
        }
        return $this->guest_name ?? 'Guest';
    }

    /**
     * Returns patient contact (logged-in or guest).
     */
    public function getPatientPhoneAttribute(): ?string
    {
        if ($this->patient) {
            return $this->patient->phone ?? null;
        }
        return $this->guest_phone;
    }

    public function isGuest(): bool
    {
        return is_null($this->patient_id);
    }
}
