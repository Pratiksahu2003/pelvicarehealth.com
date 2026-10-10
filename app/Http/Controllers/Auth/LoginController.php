<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // If user is already logged in, redirect to appropriate dashboard
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->isSuperAdmin()) {
                return redirect()->route('super-admin.dashboard');
            } elseif ($user->isAdmin()) {
                $profile = $user->doctorProfile;
                // If registration not complete, redirect to registration
                if (!$profile || !$profile->profile_completed) {
                    if (!$profile) {
                        return redirect()->route('doctor.registration.step2');
                    }
                    if (empty($profile->service_category_ids)) {
                        return redirect()->route('doctor.registration.step3');
                    }
                    if (!$profile->home_visit_fee && !$profile->clinic_visit_fee) {
                        return redirect()->route('doctor.registration.step4');
                    }
                }
                return redirect()->route('doctor.dashboard');
            } elseif ($user->isPatient()) {
                return redirect()->route('patient.dashboard');
            }
            
            return redirect()->route('admin.dashboard');
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $user = Auth::user();

            if ($user->trashed()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                throw ValidationException::withMessages([
                    'email' => ['This account is no longer active. Please contact support.'],
                ]);
            }

            $request->session()->regenerate();
            
            // For doctors, check registration completion before redirecting
            if ($user->isAdmin()) {
                $profile = $user->doctorProfile;
                if (!$profile || !$profile->profile_completed) {
                    // Redirect to appropriate registration step
                    if (!$profile) {
                        return redirect()->route('doctor.registration.step2')
                            ->with('info', 'Please complete your registration.');
                    }
                    if (empty($profile->service_category_ids)) {
                        return redirect()->route('doctor.registration.step3')
                            ->with('info', 'Please complete your profile.');
                    }
                    if (!$profile->home_visit_fee && !$profile->clinic_visit_fee) {
                        return redirect()->route('doctor.registration.step4')
                            ->with('info', 'Please complete your registration.');
                    }
                }
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

