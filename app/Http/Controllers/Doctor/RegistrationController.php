<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\DoctorDocument;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    public function step1()
    {
        // If user is already logged in and is a doctor, check if they've completed registration
        if (Auth::check() && Auth::user()->isAdmin()) {
            $profile = Auth::user()->doctorProfile;
            if ($profile && $profile->profile_completed) {
                // Check verification status
                if ($profile->verification_status === 'approved') {
                    return redirect()->route('doctor.dashboard')
                        ->with('info', 'You have already completed registration.');
                } else {
                    // Registration complete but not verified - go to dashboard (it will show pending banner)
                    return redirect()->route('doctor.dashboard')
                        ->with('info', 'Your registration is complete. Please wait for verification.');
                }
            }
            // If they have a profile but haven't completed, redirect to appropriate step
            if ($profile) {
                if (empty($profile->service_category_ids)) {
                    return redirect()->route('doctor.registration.step3')
                        ->with('info', 'Please continue your registration.');
                }
                if (!$profile->home_visit_fee && !$profile->clinic_visit_fee) {
                    return redirect()->route('doctor.registration.step4')
                        ->with('info', 'Please continue your registration.');
                }
            } else {
                // Has account but no profile, go to step 2
                return redirect()->route('doctor.registration.step2')
                    ->with('info', 'Please continue your registration.');
            }
        }
        
        return view('doctor.registration.step1');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => 'required|string|max:20|regex:/^[+]?[0-9]{10,15}$/',
        ], [
            'phone.regex' => 'Please enter a valid phone number (10-15 digits, + optional)',
        ]);

        // Check if user is already logged in
        if (Auth::check()) {
            return redirect()->route('doctor.registration.step2');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'admin',
        ]);

        Auth::login($user);

        return redirect()->route('doctor.registration.step2')
            ->with('success', 'Account created! Now let\'s verify your credentials.');
    }

    public function step2()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('doctor.registration.step1');
        }

        $user = Auth::user();
        $profile = $user->doctorProfile;
        
        // If profile is already completed, redirect to complete page
        if ($profile && $profile->profile_completed) {
            return redirect()->route('doctor.registration.complete');
        }

        // Get uploaded documents to show which ones are already uploaded
        $documents = $user->doctorDocuments;
        
        return view('doctor.registration.step2', compact('documents', 'profile'));
    }

    public function storeStep2(Request $request)
    {
        $user = Auth::user();
        
        // Check which documents are already uploaded (only degree and government_id are required)
        $existingDocs = $user->doctorDocuments;
        $hasDegreeCert = $existingDocs->where('document_type', 'degree_certificate')->first();
        $hasGovId = $existingDocs->where('document_type', 'government_id')->first();

        // Validate - only degree_certificate and government_id are required; council_registration and certifications are optional
        $rules = [
            'profile_image' => 'nullable|image|mimes:jpeg,jpg,png|max:1024', // 1MB max
            'profile_image_cropped' => 'nullable|string',
            'council_registration' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'iap_membership' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'clinic_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'certified_womens_health_physiotherapy' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'certified_reproductive_health_therapist' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'certified_pelvic_floor_rehab_therapist' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'certified_pregnancy_postnatal_rehab_therapist' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'certified_lactation_counselor' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];

        if (!$hasDegreeCert) {
            $rules['degree_certificate'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
        } else {
            $rules['degree_certificate'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }

        if (!$hasGovId) {
            $rules['government_id'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
        } else {
            $rules['government_id'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }

        $request->validate($rules);

        // Upload documents (only if new files are provided)
        $documents = [
            'degree_certificate' => $request->file('degree_certificate'),
            'council_registration' => $request->file('council_registration'),
            'government_id' => $request->file('government_id'),
            'iap_membership' => $request->file('iap_membership'),
            'clinic_proof' => $request->file('clinic_proof'),
            'certified_womens_health_physiotherapy' => $request->file('certified_womens_health_physiotherapy'),
            'certified_reproductive_health_therapist' => $request->file('certified_reproductive_health_therapist'),
            'certified_pelvic_floor_rehab_therapist' => $request->file('certified_pelvic_floor_rehab_therapist'),
            'certified_pregnancy_postnatal_rehab_therapist' => $request->file('certified_pregnancy_postnatal_rehab_therapist'),
            'certified_lactation_counselor' => $request->file('certified_lactation_counselor'),
        ];

        foreach ($documents as $type => $file) {
            if ($file) {
                $path = $file->store('doctor-documents', 'public_html');
                
                DoctorDocument::updateOrCreate(
                    [
                        'doctor_id' => $user->id,
                        'document_type' => $type,
                    ],
                    [
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                        'status' => 'pending',
                    ]
                );
            }
        }

        // Handle profile image upload (cropped)
        if ($request->has('profile_image_cropped') && $request->profile_image_cropped) {
            $this->saveCroppedProfileImage($user, $request->profile_image_cropped);
        } elseif ($request->hasFile('profile_image')) {
            // Fallback: if cropped image not provided, use original (shouldn't happen but just in case)
            $file = $request->file('profile_image');
            if ($file->getSize() <= 1024 * 1024) { // 1MB check
                $path = $file->store('doctor-profiles', 'public_html');
                $this->updateDoctorProfileImage($user, $path);
            }
        }

        return redirect()->route('doctor.registration.step3')
            ->with('success', 'Documents uploaded successfully! Now let\'s build your profile.');
    }

    public function step3()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('doctor.registration.step1');
        }

        $user = Auth::user();
        
        // Check if required documents are uploaded (step2 completed) – only degree and government_id required
        $documents = $user->doctorDocuments;
        $requiredDocs = ['degree_certificate', 'government_id'];
        $hasRequiredDocs = true;

        foreach ($requiredDocs as $docType) {
            if (!$documents->where('document_type', $docType)->first()) {
                $hasRequiredDocs = false;
                break;
            }
        }

        if (!$hasRequiredDocs) {
            return redirect()->route('doctor.registration.step2')
                ->with('error', 'Please upload all required documents first.');
        }
        
        $profile = $user->doctorProfile;
        
        // If profile is already completed, redirect to complete page
        if ($profile && $profile->profile_completed) {
            return redirect()->route('doctor.registration.complete');
        }

        $serviceCategories = ServiceCategory::active()->ordered()->get();
        return view('doctor.registration.step3', compact('profile', 'serviceCategories'));
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            'years_of_experience' => 'required|integer|min:0',
            'service_category_ids' => 'required|array|min:1',
            'service_category_ids.*' => 'exists:service_categories,id',
            'specializations' => 'nullable|array',
            'specializations.*' => 'string',
            'languages' => 'required|array|min:1',
            'languages.*' => 'string',
            'bio' => 'nullable|string',
            'clinic_name' => 'nullable|string|max:255',
            'clinic_address' => 'nullable|string',
            'state' => [
                'required',
                'string',
                \Illuminate\Validation\Rule::in(array_keys(config('pelvicare.locations', []))),
            ],
        ], [
            'state.required' => 'Please select your State or Union Territory.',
            'state.in'       => 'Please select a valid Indian State or Union Territory.',
        ]);

        $user = Auth::user();
        $categoryIds = array_map('intval', $request->service_category_ids);

        $profile = DoctorProfile::firstOrNew(['user_id' => $user->id]);
        $slug = $profile->slug ?? DoctorProfile::generateSlug($user->name, $user->id);

        DoctorProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'years_of_experience' => $request->years_of_experience,
                'service_category_ids' => array_values(array_unique($categoryIds)),
                'service_subcategory_ids' => null, // set on step 4
                'specializations' => $request->specializations ?? [],
                'languages' => $request->input('languages'),
                'bio' => $request->bio,
                'clinic_name' => $request->clinic_name,
                'clinic_address' => $request->clinic_address,
                'state' => $request->state,
                'verification_status' => 'pending',
                'slug' => $slug,
            ]
        );

        return redirect()->route('doctor.registration.step4')
            ->with('success', 'Profile information saved! Now let\'s set your consultation fees and availability.');
    }

    public function step4()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('doctor.registration.step1');
        }

        $user = Auth::user();
        $profile = $user->doctorProfile;
        
        // Check if step3 is completed (at least one service category must exist)
        if (!$profile || empty($profile->service_category_ids)) {
            return redirect()->route('doctor.registration.step3')
                ->with('error', 'Please select at least one service category first.');
        }
        
        // If profile is already completed, redirect to complete page
        if ($profile->profile_completed) {
            return redirect()->route('doctor.registration.complete');
        }

        $categoriesWithSubs = ServiceCategory::whereIn('id', $profile->service_category_ids)
            ->ordered()
            ->get()
            ->map(function ($category) {
                return [
                    'category' => $category,
                    'subcategories' => ServiceSubcategory::where('service_category_id', $category->id)
                        ->active()
                        ->ordered()
                        ->get(),
                ];
            });
        
        return view('doctor.registration.step4', compact('profile', 'categoriesWithSubs'));
    }

    public function storeStep4(Request $request)
    {
        \Log::info('=== STEP 4 SUBMISSION START ===');
        \Log::info('Request Method: ' . $request->method());
        \Log::info('Request URL: ' . $request->fullUrl());
        \Log::info('All Request Data: ', $request->all());
        \Log::info('Auth Check: ' . (Auth::check() ? 'YES' : 'NO'));
        
        if (Auth::check()) {
            \Log::info('User ID: ' . Auth::id());
            \Log::info('User Role: ' . Auth::user()->role);
            \Log::info('Is Admin: ' . (Auth::user()->isAdmin() ? 'YES' : 'NO'));
        }

        try {
            // Validate request
            \Log::info('Starting validation...');
            
            // Convert slot_duration to integer if it's a string
            if ($request->has('slot_duration')) {
                $slotDuration = $request->slot_duration;
                \Log::info('Slot Duration (raw): ' . var_export($slotDuration, true));
                \Log::info('Slot Duration Type: ' . gettype($slotDuration));
                
                // Ensure it's treated as integer for validation
                if (is_string($slotDuration)) {
                    $request->merge(['slot_duration' => (int) $slotDuration]);
                }
            }
            
            // Convert other integer fields
            if ($request->has('max_patients_per_day')) {
                $maxPatients = $request->max_patients_per_day;
                \Log::info('Max Patients (raw): ' . var_export($maxPatients, true));
                if (is_string($maxPatients)) {
                    $request->merge(['max_patients_per_day' => (int) $maxPatients]);
                }
            }
            
            if ($request->has('buffer_time')) {
                $bufferTime = $request->buffer_time;
                \Log::info('Buffer Time (raw): ' . var_export($bufferTime, true));
                if (is_string($bufferTime)) {
                    $request->merge(['buffer_time' => (int) $bufferTime]);
                }
            }
            
            $validated = $request->validate([
                'service_subcategory_ids' => 'nullable|array',
                'service_subcategory_ids.*' => 'exists:service_subcategories,id',
                'home_visit_fee' => 'nullable|numeric|min:0',
                'clinic_visit_fee' => 'nullable|numeric|min:0',
                'video_session_fee' => 'nullable|numeric|min:0',
                'slot_duration' => 'required|integer|in:30,45,60',
                'max_patients_per_day' => 'required|integer|min:1|max:50',
                'buffer_time' => 'required|integer|min:0|max:60',
                'same_day_bookings' => 'nullable', // Checkbox sends "on" when checked, we handle it with has()
            ], [
                'service_subcategory_ids.*.exists' => 'One or more selected subcategories are invalid.',
                'slot_duration.required' => 'Please select a slot duration.',
                'slot_duration.integer' => 'Slot duration must be a number.',
                'slot_duration.in' => 'Slot duration must be 30, 45, or 60 minutes.',
                'max_patients_per_day.required' => 'Please specify the maximum number of patients per day.',
                'max_patients_per_day.integer' => 'Maximum patients must be a number.',
                'max_patients_per_day.min' => 'You must accept at least 1 patient per day.',
                'max_patients_per_day.max' => 'Maximum patients per day cannot exceed 50.',
                'buffer_time.required' => 'Please specify buffer time between appointments.',
                'buffer_time.integer' => 'Buffer time must be a number.',
                'buffer_time.min' => 'Buffer time cannot be negative.',
                'buffer_time.max' => 'Buffer time cannot exceed 60 minutes.',
            ]);
            
            \Log::info('Validation passed!');
            \Log::info('Validated Data: ', $validated);

            // Ensure user is authenticated
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                \Log::warning('Authentication failed or user is not admin');
                return redirect()->route('doctor.registration.step1')
                    ->with('error', 'Please log in to continue registration.');
            }

            $user = Auth::user();
            \Log::info('User authenticated: ' . $user->email);
            
            // Update profile (it should exist from step 3)
            $profile = $user->doctorProfile;
            
            if (!$profile) {
                \Log::error('Profile does not exist for user: ' . $user->id);
                return redirect()->route('doctor.registration.step3')
                    ->with('error', 'Please complete your profile information first.')
                    ->withInput();
            }
            
            \Log::info('Profile found. Profile ID: ' . $profile->id);
            \Log::info('Profile Specializations: ' . json_encode($profile->specializations));
            
            // Check if step 3 is completed (at least one service category must exist)
            if (empty($profile->service_category_ids)) {
                \Log::warning('Service categories missing');
                return redirect()->route('doctor.registration.step3')
                    ->with('error', 'Please select at least one service category first.')
                    ->withInput();
            }

            $subcategoryIds = $request->service_subcategory_ids ? array_map('intval', $request->service_subcategory_ids) : [];
            $validSubcategoryIds = ServiceSubcategory::whereIn('id', $subcategoryIds)
                ->whereIn('service_category_id', $profile->service_category_ids)
                ->pluck('id')
                ->all();
            if (count($subcategoryIds) !== count($validSubcategoryIds)) {
                return redirect()->back()
                    ->withErrors(['service_subcategory_ids' => 'One or more selected subcategories do not belong to your service categories.'])
                    ->withInput();
            }
            
            \Log::info('Starting profile update...');

            // Ensure slug is set (in case it was missed in earlier steps)
            $slug = $profile->slug ?? DoctorProfile::generateSlug($user->name, $user->id);

            // Update fee, settings, and service subcategories
            $profile->update([
                'slug' => $slug,
                'service_subcategory_ids' => array_values(array_unique($validSubcategoryIds)),
                'home_visit_fee' => $request->home_visit_fee ? (float) $request->home_visit_fee : null,
                'clinic_visit_fee' => $request->clinic_visit_fee ? (float) $request->clinic_visit_fee : null,
                'video_session_fee' => $request->video_session_fee ? (float) $request->video_session_fee : null,
                'slot_duration' => (int) $request->slot_duration,
                'max_patients_per_day' => (int) $request->max_patients_per_day,
                'buffer_time' => (int) $request->buffer_time,
                'same_day_bookings' => $request->has('same_day_bookings'),
                'profile_completed' => true,
            ]);
            
            \Log::info('Profile updated successfully!');
            \Log::info('Profile Completed Status: ' . ($profile->fresh()->profile_completed ? 'YES' : 'NO'));

            // Regenerate session to prevent issues
            $request->session()->regenerate();
            \Log::info('Session regenerated');

            \Log::info('Redirecting to dashboard...');
            \Log::info('=== STEP 4 SUBMISSION SUCCESS ===');

            return redirect()->route('doctor.dashboard')
                ->with('success', 'Registration completed successfully! Your account is pending verification.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('=== VALIDATION ERROR ===');
            \Log::error('Validation Errors: ', $e->errors());
            \Log::error('Request Data: ', $request->all());
            \Log::error('=== END VALIDATION ERROR ===');
            
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
                
        } catch (\Exception $e) {
            // Log error and redirect back with error message
            \Log::error('=== EXCEPTION IN STEP 4 ===');
            \Log::error('Error Message: ' . $e->getMessage());
            \Log::error('Error File: ' . $e->getFile());
            \Log::error('Error Line: ' . $e->getLine());
            \Log::error('Stack Trace: ' . $e->getTraceAsString());
            \Log::error('Request Data: ', $request->all());
            \Log::error('=== END EXCEPTION ===');
            
            return redirect()->back()
                ->with('error', 'An error occurred while saving your information: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Return subcategories for a service category (for AJAX / dynamic dropdowns).
     */
    public function subcategoriesByCategory(Request $request)
    {
        $request->validate(['category_id' => 'required|exists:service_categories,id']);
        $subcategories = ServiceSubcategory::where('service_category_id', $request->category_id)
            ->active()
            ->ordered()
            ->get(['id', 'name']);
        return response()->json($subcategories);
    }

    public function complete()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('doctor.registration.step1');
        }

        $user = Auth::user();
        $profile = $user->doctorProfile;
        
        // Check if registration is actually complete
        if (!$profile || !$profile->profile_completed) {
            // Redirect to appropriate step
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
        
        return view('doctor.registration.complete', compact('profile'));
    }

    /**
     * Save cropped profile image from base64 string
     */
    private function saveCroppedProfileImage($user, $base64Image)
    {
        // Remove data URL prefix if present
        $base64Image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
        $imageData = base64_decode($base64Image);
        
        if ($imageData === false) {
            return false;
        }
        
        // Generate unique filename
        $filename = 'profile_' . $user->id . '_' . time() . '.jpg';
        $path = 'doctor-profiles/' . $filename;
        
        // Delete old profile image if exists
        $profile = $user->doctorProfile;
        if ($profile && $profile->profile_image) {
            $oldPath = $profile->profile_image;
            if (Storage::disk('public_html')->exists($oldPath)) {
                Storage::disk('public_html')->delete($oldPath);
            }
        }
        
        // Save new image
        Storage::disk('public_html')->put($path, $imageData);
        
        // Update or create profile with image path
        if ($profile) {
            $profile->update(['profile_image' => $path]);
        } else {
            DoctorProfile::create([
                'user_id' => $user->id,
                'profile_image' => $path,
                'slug' => DoctorProfile::generateSlug($user->name, $user->id),
            ]);
        }
        
        return true;
    }

    /**
     * Update doctor profile image
     */
    private function updateDoctorProfileImage($user, $path)
    {
        $profile = $user->doctorProfile;
        
        // Delete old profile image if exists
        if ($profile && $profile->profile_image && $profile->profile_image !== $path) {
            if (Storage::disk('public_html')->exists($profile->profile_image)) {
                Storage::disk('public_html')->delete($profile->profile_image);
            }
        }
        
        // Update or create profile with image path
        if ($profile) {
            $profile->update(['profile_image' => $path]);
        } else {
            DoctorProfile::create([
                'user_id' => $user->id,
                'profile_image' => $path,
                'slug' => DoctorProfile::generateSlug($user->name, $user->id),
            ]);
        }
    }
}

