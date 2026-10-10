<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientDocument extends Model
{
    protected $fillable = [
        'patient_id',
        'document_type',
        'title',
        'file_path',
        'file_name',
        'description',
        'document_date',
    ];

    protected $casts = [
        'document_date' => 'date',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}

