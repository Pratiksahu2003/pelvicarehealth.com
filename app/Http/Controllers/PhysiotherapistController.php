<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhysiotherapistController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register-physiotherapist');
    }
    
    public function store(Request $request)
    {
        // This is a UI-only implementation
        // In production, you would validate and store the registration
        return redirect()->route('register-physiotherapist')->with('success', 'Registration received! Our team will review and contact you within 48 hours.');
    }
}
