<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class AppointmentSlot extends Model
{
    protected $fillable = [
        'doctor_id',
        'appointment_date',
        'slot_time',
        'is_booked',
        'appointment_id',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'is_booked'        => 'boolean',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    // ─── Scopes ───────────────────────────────────────────────────────────────

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_booked', false);
    }

    public function scopeForDoctor(Builder $query, int $doctorId): Builder
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeForDate(Builder $query, string $date): Builder
    {
        return $query->where('appointment_date', $date);
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    /**
     * Human-readable slot time (e.g. "09:30 AM").
     */
    public function getFormattedTimeAttribute(): string
    {
        return date('h:i A', strtotime($this->slot_time));
    }
}
