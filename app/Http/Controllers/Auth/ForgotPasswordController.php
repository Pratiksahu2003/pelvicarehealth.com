<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetOtp;
use App\Models\User;
use App\Mail\PasswordResetOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /**
     * Show the forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send OTP to user's email
     */
    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'We could not find a user with that email address.',
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Create or update OTP
        $otpRecord = PasswordResetOtp::createOrUpdateOtp($request->email);

        // Send OTP via email
        try {
            Mail::to($user->email)->send(new PasswordResetOtpMail($otpRecord->otp, $user->name));
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again later.'])->withInput();
        }

        return redirect()->route('password.verify-otp')
            ->with('email', $request->email)
            ->with('success', 'OTP has been sent to your email address. Please check your inbox.');
    }

    /**
     * Show the OTP verification form
     */
    public function showVerifyOTPForm(Request $request)
    {
        $email = $request->session()->get('email') ?? $request->query('email');
        
        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Please request a password reset first.']);
        }

        return view('auth.verify-otp', compact('email'));
    }

    /**
     * Verify OTP
     */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|size:6',
        ]);

        $otpRecord = PasswordResetOtp::findValidOtp($request->email, $request->otp);

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP. Please try again.'])->withInput();
        }

        // Mark OTP as verified
        $otpRecord->markAsVerified();

        // Store email in session for password reset
        $request->session()->put('verified_email', $request->email);
        $request->session()->put('otp_verified', true);

        return redirect()->route('password.reset')
            ->with('success', 'OTP verified successfully. Please set your new password.');
    }

    /**
     * Show the reset password form
     */
    public function showResetPasswordForm(Request $request)
    {
        if (!$request->session()->has('otp_verified') || !$request->session()->has('verified_email')) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Please verify your OTP first.']);
        }

        $email = $request->session()->get('verified_email');
        return view('auth.reset-password', compact('email'));
    }

    /**
     * Reset the password
     */
    public function resetPassword(Request $request)
    {
        if (!$request->session()->has('otp_verified') || !$request->session()->has('verified_email')) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Session expired. Please request a new OTP.']);
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 8 characters.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Invalidate all OTPs for this email
        PasswordResetOtp::where('email', $request->email)->update(['is_verified' => true]);

        // Clear session
        $request->session()->forget(['otp_verified', 'verified_email', 'email']);

        return redirect()->route('login')
            ->with('success', 'Password reset successfully! You can now login with your new password.');
    }

    /**
     * Resend OTP
     */
    public function resendOTP(Request $request)
    {
        $email = $request->session()->get('email') ?? $request->input('email');
        
        if (!$email) {
            return back()->withErrors(['email' => 'Email address is required.']);
        }

        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // Create or update OTP
        $otpRecord = PasswordResetOtp::createOrUpdateOtp($email);

        // Send OTP via email
        try {
            Mail::to($user->email)->send(new PasswordResetOtpMail($otpRecord->otp, $user->name));
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again later.'])->withInput();
        }

        return back()->with('success', 'A new OTP has been sent to your email address.');
    }
}
