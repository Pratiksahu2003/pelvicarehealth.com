<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\DoctorAvailability;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    // ─── Step 1: Location Picker + Doctor Grid ────────────────────────────────

    public function index(Request $request)
    {
        $selectedState = $request->get('state');

        // All States/UTs from the central config (single source of truth)
        $states = collect(array_keys(config('pelvicare.locations', [])));

        // Doctors query
        $query = User::where('role', 'admin')
            ->whereHas('doctorProfile', function ($q) {
                $q->where('verification_status', 'approved')
                  ->where('profile_completed', true);
            })
            ->with('doctorProfile');

        if ($selectedState) {
            $query->whereHas('doctorProfile', function ($q) use ($selectedState) {
                // Check new `state` column first; fall back to `city` for legacy records
                $q->where(function ($sub) use ($selectedState) {
                    $sub->where('state', $selectedState)
                        ->orWhere('city', $selectedState);
                });
            });
        }

        $doctors = $query->get();

        return view('booking.index', compact('states', 'doctors', 'selectedState'));
    }

    // ─── AJAX: Doctors by State/UT ─────────────────────────────────────────────

    public function getDoctors(Request $request)
    {
        $state = $request->get('state');

        $query = User::where('role', 'admin')
            ->whereHas('doctorProfile', function ($q) {
                $q->where('verification_status', 'approved')
                  ->where('profile_completed', true);
            })
            ->with('doctorProfile');

        if ($state) {
            $query->whereHas('doctorProfile', function ($q) use ($state) {
                $q->where(function ($sub) use ($state) {
                    $sub->where('state', $state)
                        ->orWhere('city', $state);
                });
            });
        }

        $doctors = $query->get()->map(function ($doc) {
            $profile = $doc->doctorProfile;
            return [
                'id'             => $doc->id,
                'name'           => $doc->name,
                'slug'           => $profile->slug,
                'specializations'=> $profile->specializations ?? [],
                'clinic_name'    => $profile->clinic_name,
                'state'          => $profile->state ?: $profile->city,
                'rating'         => $profile->rating,
                'experience'     => $profile->years_of_experience,
                'profile_image'  => $profile->profile_image
                                        ? media_url($profile->profile_image)
                                        : null,
                'clinic_visit_fee' => $profile->clinic_visit_fee,
                'video_session_fee' => $profile->video_session_fee,
                'home_visit_fee'   => $profile->home_visit_fee,
                'book_url'       => route('booking.doctor', $profile->slug),
            ];
        });

        return response()->json(['doctors' => $doctors]);
    }

    // ─── Step 2: Doctor Detail Page ────────────────────────────────────────────

    public function showDoctor(string $slug)
    {
        $doctor = User::where('role', 'admin')
            ->whereHas('doctorProfile', function ($q) use ($slug) {
                $q->where('verification_status', 'approved')
                  ->where('profile_completed', true)
                  ->where('slug', $slug);
            })
            ->with(['doctorProfile.faqs', 'doctorProfile.photos', 'availabilities'])
            ->firstOrFail();

        // Collect available days (e.g. ['monday', 'wednesday'])
        $availableDays = $doctor->availabilities
            ->where('is_available', true)
            ->pluck('day_of_week')
            ->unique()
            ->values();

        return view('booking.doctor', compact('doctor', 'availableDays'));
    }

    // ─── AJAX: Available Slots for Doctor + Date ───────────────────────────────

    public function getSlots(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date'      => 'required|date|after_or_equal:today',
        ]);

        $doctorId = $request->get('doctor_id');
        $date     = Carbon::parse($request->get('date'));
        $dayName  = strtolower($date->format('l')); // e.g. 'monday'

        // Get availability for this day
        $availability = DoctorAvailability::where('doctor_id', $doctorId)
            ->where('day_of_week', $dayName)
            ->where('is_available', true)
            ->first();

        if (! $availability) {
            return response()->json(['slots' => [], 'message' => 'Doctor not available on this day.']);
        }

        // Fetch doctor profile for slot duration/buffer
        $doctor  = User::with('doctorProfile')->find($doctorId);
        $profile = $doctor->doctorProfile;
        $slotDuration = $profile->slot_duration ?? 30; // minutes
        $bufferTime   = $profile->buffer_time   ?? 0;  // minutes
        $interval     = $slotDuration + $bufferTime;

        // Generate all possible slots for the day
        // start_time/end_time are cast to datetime in the model, so we must format them to H:i:s
        $start   = Carbon::parse($date->format('Y-m-d') . ' ' . $availability->start_time->format('H:i:s'));
        $end     = Carbon::parse($date->format('Y-m-d') . ' ' . $availability->end_time->format('H:i:s'));
        $allSlots = [];

        $current = $start->copy();
        while ($current->copy()->addMinutes($slotDuration)->lte($end)) {
            $allSlots[] = $current->format('H:i:s');
            $current->addMinutes($interval);
        }

        if (empty($allSlots)) {
            return response()->json(['slots' => [], 'message' => 'No slots available.']);
        }

        // Get already-booked slots (from appointments table directly for real-time safety)
        $bookedTimes = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $date->format('Y-m-d'))
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('appointment_time')
            ->map(fn($t) => Carbon::parse($t)->format('H:i:s'))
            ->toArray();

        // Also check appointment_slots table
        $bookedSlots = AppointmentSlot::where('doctor_id', $doctorId)
            ->where('appointment_date', $date->format('Y-m-d'))
            ->where('is_booked', true)
            ->pluck('slot_time')
            ->map(fn($t) => Carbon::parse($t)->format('H:i:s'))
            ->toArray();

        $allBooked = array_unique(array_merge($bookedTimes, $bookedSlots));

        $slots = collect($allSlots)->map(function ($time) use ($allBooked) {
            return [
                'time'         => $time,
                'display_time' => date('h:i A', strtotime($time)),
                'is_booked'    => in_array($time, $allBooked),
            ];
        });

        return response()->json(['slots' => $slots]);
    }

    // ─── Step 3: Store Appointment ─────────────────────────────────────────────

    public function store(Request $request, string $slug)
    {
        $doctor = User::where('role', 'admin')
            ->whereHas('doctorProfile', function ($q) use ($slug) {
                $q->where('slug', $slug)
                  ->where('verification_status', 'approved');
            })
            ->with('doctorProfile')
            ->firstOrFail();

        // --- Validation ---
        $rules = [
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'session_type'     => 'required|in:home_visit,clinic_visit,video_session',
            'reason'           => 'nullable|string|max:1000',
            'notes'            => 'nullable|string|max:500',
        ];

        if (auth()->check()) {
            // Authenticated user — no extra fields needed
        } else {
            // Guest — need contact info
            $rules['guest_name']  = 'required|string|max:100';
            $rules['guest_phone'] = 'required|string|max:20';
            $rules['guest_email'] = 'nullable|email|max:100';
        }

        $validated = $request->validate($rules);

        $date     = $validated['appointment_date'];
        $time     = Carbon::parse($validated['appointment_time'])->format('H:i:s');
        $dayName  = strtolower(Carbon::parse($date)->format('l'));

        // --- Verify slot is still available (race-condition safe) ---
        try {
            $appointment = DB::transaction(function () use ($doctor, $date, $time, $dayName, $validated, $request) {

                // Lock the slot row (or create it) and check if already booked
                $slot = AppointmentSlot::lockForUpdate()
                    ->where('doctor_id', $doctor->id)
                    ->where('appointment_date', $date)
                    ->where('slot_time', $time)
                    ->first();

                if ($slot && $slot->is_booked) {
                    throw new \Exception('slot_taken');
                }

                // Determine session fee
                $profile = $doctor->doctorProfile;
                $sessionFee = match ($validated['session_type']) {
                    'home_visit'    => $profile->home_visit_fee,
                    'video_session' => $profile->video_session_fee,
                    default         => $profile->clinic_visit_fee,
                };

                // Create appointment
                $appt = Appointment::create([
                    'patient_id'       => auth()->id(),
                    'doctor_id'        => $doctor->id,
                    'appointment_date' => $date,
                    'appointment_time' => $validated['appointment_time'],
                    'session_type'     => $validated['session_type'],
                    'session_fee'      => $sessionFee,
                    'patient_address'  => $request->get('patient_address'),
                    'status'           => 'pending',
                    'reason'           => $validated['reason'] ?? null,
                    'notes'            => $validated['notes'] ?? null,
                    'guest_name'       => auth()->check() ? null : $request->get('guest_name'),
                    'guest_phone'      => auth()->check() ? null : $request->get('guest_phone'),
                    'guest_email'      => auth()->check() ? null : $request->get('guest_email'),
                ]);

                // Upsert slot as booked
                AppointmentSlot::updateOrCreate(
                    [
                        'doctor_id'        => $doctor->id,
                        'appointment_date' => $date,
                        'slot_time'        => $time,
                    ],
                    [
                        'is_booked'      => true,
                        'appointment_id' => $appt->id,
                    ]
                );

                return $appt;
            });
        } catch (\Exception $e) {
            if ($e->getMessage() === 'slot_taken') {
                return back()
                    ->withInput()
                    ->with('error', 'Sorry, this slot was just booked by someone else. Please choose another time.');
            }
            throw $e;
        }

        return redirect()->route('booking.confirmation', $appointment->id);
    }

    // ─── Step 4: Booking Confirmation ─────────────────────────────────────────

    public function confirmation(int $id)
    {
        $appointment = Appointment::with(['doctor.doctorProfile'])->findOrFail($id);

        return view('booking.success', compact('appointment'));
    }
}
