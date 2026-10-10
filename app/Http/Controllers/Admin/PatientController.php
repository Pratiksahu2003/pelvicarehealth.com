<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function dashboard()
    {
        $patient = auth()->user();
        
        $stats = [
            'total_appointments' => Appointment::where('patient_id', $patient->id)->count(),
            'pending_appointments' => Appointment::where('patient_id', $patient->id)
                ->where('status', 'pending')->count(),
            'confirmed_appointments' => Appointment::where('patient_id', $patient->id)
                ->where('status', 'confirmed')->count(),
            'total_reports' => Report::where('patient_id', $patient->id)->count(),
        ];

        $upcoming_appointments = Appointment::with('doctor')
            ->where('patient_id', $patient->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('appointment_date', '>=', now())
            ->orderBy('appointment_date')
            ->take(5)
            ->get();

        $recent_reports = Report::with('doctor')
            ->where('patient_id', $patient->id)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.patient.dashboard', compact('stats', 'upcoming_appointments', 'recent_reports'));
    }

    public function appointments()
    {
        $patient = auth()->user();
        $appointments = Appointment::with('doctor')
            ->where('patient_id', $patient->id)
            ->latest()
            ->paginate(20);

        return view('admin.patient.appointments', compact('appointments'));
    }

    public function bookAppointment()
    {
        $doctors = User::where('role', 'admin')->get();
        return view('admin.patient.book-appointment', compact('doctors'));
    }

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'session_type' => 'required|in:home_visit,clinic_visit,video_session',
            'reason' => 'nullable|string',
            'patient_address' => 'required_if:session_type,home_visit|nullable|string',
        ]);

        $doctor = User::findOrFail($request->doctor_id);
        $profile = $doctor->doctorProfile;
        
        $fee = 0;
        if ($profile) {
            switch($request->session_type) {
                case 'home_visit':
                    $fee = $profile->home_visit_fee ?? 0;
                    break;
                case 'clinic_visit':
                    $fee = $profile->clinic_visit_fee ?? 0;
                    break;
                case 'video_session':
                    $fee = $profile->video_session_fee ?? 0;
                    break;
            }
        }

        Appointment::create([
            'patient_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'session_type' => $request->session_type,
            'session_fee' => $fee,
            'patient_address' => $request->patient_address,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('patient.appointments')->with('success', 'Appointment booked successfully.');
    }

    public function rebookAppointment($id)
    {
        $oldAppointment = Appointment::where('patient_id', auth()->id())->findOrFail($id);
        $doctors = User::where('role', 'admin')->get();
        
        return view('admin.patient.rebook-appointment', compact('oldAppointment', 'doctors'));
    }

    public function storeRebookAppointment(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'reason' => 'nullable|string',
        ]);

        Appointment::create([
            'patient_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason ?? $request->old_reason,
            'status' => 'pending',
        ]);

        return redirect()->route('patient.appointments')->with('success', 'Appointment rebooked successfully.');
    }

    public function reports()
    {
        $patient = auth()->user();
        $reports = Report::with('doctor')
            ->where('patient_id', $patient->id)
            ->latest()
            ->paginate(20);

        return view('admin.patient.reports', compact('reports'));
    }

    public function viewReport($id)
    {
        $report = Report::with(['doctor', 'appointment'])
            ->where('patient_id', auth()->id())
            ->findOrFail($id);

        return view('admin.patient.view-report', compact('report'));
    }
}

