<?php

namespace App\Models;

use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class DoctorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'slug',
        'years_of_experience',
        'rating',
        'specializations',
        'languages',
        'service_category_ids',
        'service_subcategory_ids',
        'verification_status',
        'rejection_reason',
        'verified_by',
        'verified_at',
        'bio',
        'clinic_name',
        'clinic_address',
        'city',
        'state',
        'profile_image',
        'home_visit_fee',
        'clinic_visit_fee',
        'video_session_fee',
        'slot_duration',
        'max_patients_per_day',
        'buffer_time',
        'same_day_bookings',
        'profile_completed',
        'is_featured',
    ];

    protected $casts = [
        'specializations' => 'array',
        'languages' => 'array',
        'service_category_ids' => 'array',
        'service_subcategory_ids' => 'array',
        'rating' => 'decimal:2',
        'home_visit_fee' => 'decimal:2',
        'clinic_visit_fee' => 'decimal:2',
        'video_session_fee' => 'decimal:2',
        'verified_at' => 'datetime',
        'same_day_bookings' => 'boolean',
        'profile_completed' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(DoctorDocument::class, 'doctor_id', 'user_id');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(DoctorFaq::class)->orderBy('sort_order');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(DoctorPhoto::class)->orderBy('sort_order');
    }

    public function galleryPhotos(): HasMany
    {
        return $this->hasMany(DoctorPhoto::class)->where('type', 'gallery')->orderBy('sort_order');
    }

    public function clinicPhotos(): HasMany
    {
        return $this->hasMany(DoctorPhoto::class)->where('type', 'clinic')->orderBy('sort_order');
    }

    public function serviceCategories(): \Illuminate\Database\Eloquent\Collection
    {
        if (empty($this->service_category_ids)) {
            return new \Illuminate\Database\Eloquent\Collection([]);
        }
        return ServiceCategory::whereIn('id', $this->service_category_ids)->ordered()->get();
    }

    public function serviceSubcategories(): \Illuminate\Database\Eloquent\Collection
    {
        if (empty($this->service_subcategory_ids)) {
            return new \Illuminate\Database\Eloquent\Collection([]);
        }
        return ServiceSubcategory::whereIn('id', $this->service_subcategory_ids)->ordered()->get();
    }

    /**
     * Get formatted category and subcategory names for display
     */
    public function getCategorySubcategoryDisplayAttribute(): string
    {
        $categories = $this->serviceCategories();
        $subcategories = $this->serviceSubcategories();

        if (!$categories->isEmpty() || !$subcategories->isEmpty()) {
            $parts = [];
            foreach ($categories as $cat) {
                $subs = $subcategories->where('service_category_id', $cat->id)->pluck('name')->implode(', ');
                $parts[] = $subs ? "{$cat->name} ({$subs})" : $cat->name;
            }
            $orphanSubs = $subcategories->whereNotIn('service_category_id', $categories->pluck('id'));
            foreach ($orphanSubs as $sub) {
                $parts[] = $sub->name;
            }
            return implode(', ', $parts);
        }

        // Fallback to legacy specializations
        $specs = is_array($this->specializations) ? $this->specializations : [];
        return !empty($specs) ? implode(', ', $specs) : 'N/A';
    }

    public static function generateSlug(string $name, ?int $userId = null): string
    {
        $base = Str::slug($name) ?: 'doctor';
        $slug = $base;
        $count = 0;
        while (static::where('slug', $slug)->exists()) {
            $count++;
            $slug = $userId ? "{$base}-{$userId}" : "{$base}-{$count}";
            if ($userId) {
                break; // userId is unique, no need to loop
            }
        }
        return $slug;
    }

    public function isVerified(): bool
    {
        return $this->verification_status === 'approved';
    }

    public function isPending(): bool
    {
        return $this->verification_status === 'pending';
    }
}

