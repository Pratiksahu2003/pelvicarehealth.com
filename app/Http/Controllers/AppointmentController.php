<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function showBookingForm()
    {
        return view('book-appointment');
    }
    
    public function store(Request $request)
    {
        // This is a UI-only implementation
        // In production, you would validate and store the appointment
        return redirect()->route('book-appointment')->with('success', 'Appointment request received! We will contact you shortly.');
    }
}
