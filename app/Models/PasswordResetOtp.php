<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PasswordResetOtp extends Model
{
    protected $fillable = [
        'email',
        'otp',
        'expires_at',
        'is_verified',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    /**
     * Check if OTP is valid and not expired
     */
    public function isValid(): bool
    {
        return !$this->is_verified && $this->expires_at->isFuture();
    }

    /**
     * Mark OTP as verified
     */
    public function markAsVerified(): void
    {
        $this->update(['is_verified' => true]);
    }

    /**
     * Generate a 6-digit OTP
     */
    public static function generateOtp(): string
    {
        return str_pad((string) rand(100000, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Create or update OTP for email
     */
    public static function createOrUpdateOtp(string $email): self
    {
        $otp = self::generateOtp();
        $expiresAt = Carbon::now()->addMinutes(10); // OTP valid for 10 minutes

        return self::updateOrCreate(
            ['email' => $email],
            [
                'otp' => $otp,
                'expires_at' => $expiresAt,
                'is_verified' => false,
            ]
        );
    }

    /**
     * Find valid OTP for email
     */
    public static function findValidOtp(string $email, string $otp): ?self
    {
        return self::where('email', $email)
            ->where('otp', $otp)
            ->where('is_verified', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();
    }
}
