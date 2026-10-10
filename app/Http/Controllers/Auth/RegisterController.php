<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
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
        
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => 'required|string|max:20',
            'role' => 'required|in:patient,admin',
        ]);

        // If doctor is selected, redirect to proper doctor registration flow
        if ($request->role === 'admin') {
            return redirect()->route('doctor.registration.step1')
                ->with('info', 'Please complete the doctor registration process.');
        }

        // Create patient account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'patient',
        ]);

        // Create patient profile
        \App\Models\PatientProfile::create([
            'user_id' => $user->id,
        ]);

        Auth::login($user);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Registration successful! Welcome to Pelvicare.');
    }
}

