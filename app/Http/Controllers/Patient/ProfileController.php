<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\PatientProfile;
use App\Models\PatientDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = auth()->user()->patientProfile;
        return view('admin.patient.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'current_medications' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:10',
        ]);

        $profile = auth()->user()->patientProfile;
        
        if ($profile) {
            $profile->update($request->only([
                'medical_history', 'allergies', 'current_medications',
                'emergency_contact_name', 'emergency_contact_phone',
                'address', 'city', 'state', 'pincode'
            ]));
        } else {
            PatientProfile::create(array_merge(
                ['user_id' => auth()->id()],
                $request->only([
                    'medical_history', 'allergies', 'current_medications',
                    'emergency_contact_name', 'emergency_contact_phone',
                    'address', 'city', 'state', 'pincode'
                ])
            ));
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'document_type' => 'required|in:mri,xray,prescription,lab_report,other',
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'description' => 'nullable|string',
            'document_date' => 'nullable|date',
        ]);

        $file = $request->file('file');
        $path = $file->store('patient-documents', 'public_html');

        PatientDocument::create([
            'patient_id' => auth()->id(),
            'document_type' => $request->document_type,
            'title' => $request->title,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'description' => $request->description,
            'document_date' => $request->document_date,
        ]);

        return redirect()->back()->with('success', 'Document uploaded successfully!');
    }

    public function deleteDocument($id)
    {
        $document = PatientDocument::where('patient_id', auth()->id())->findOrFail($id);
        
        if (Storage::disk('public_html')->exists($document->file_path)) {
            Storage::disk('public_html')->delete($document->file_path);
        }
        
        $document->delete();

        return redirect()->back()->with('success', 'Document deleted successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}

