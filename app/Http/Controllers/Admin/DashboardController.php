<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            return redirect()->route('super-admin.dashboard');
        } elseif ($user->isAdmin()) {
            // Check if doctor registration is complete
            $profile = $user->doctorProfile;
            if (!$profile || !$profile->profile_completed) {
                // Redirect to appropriate registration step
                if (!$profile) {
                    return redirect()->route('doctor.registration.step2')
                        ->with('info', 'Please complete your registration to access the dashboard.');
                }
                if (empty($profile->service_category_ids)) {
                    return redirect()->route('doctor.registration.step3')
                        ->with('info', 'Please complete your profile to access the dashboard.');
                }
                if (!$profile->home_visit_fee && !$profile->clinic_visit_fee) {
                    return redirect()->route('doctor.registration.step4')
                        ->with('info', 'Please complete your registration to access the dashboard.');
                }
            }
            
            return redirect()->route('doctor.dashboard');
        } elseif ($user->isPatient()) {
            return redirect()->route('patient.dashboard');
        }

        return redirect()->route('home');
    }
}
