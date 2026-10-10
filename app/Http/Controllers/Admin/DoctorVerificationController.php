<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\DoctorDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorVerificationController extends Controller
{
    public function index(Request $request)
    {
        // Default to Pending tab when no valid status
        if (!$request->has('status') || !in_array($request->status, ['pending', 'approved', 'rejected'])) {
            return redirect()->route('super-admin.doctor-verification', array_merge(
                $request->only(['search', 'city']),
                ['status' => 'pending']
            ));
        }

        $query = User::where('role', 'admin')
            ->with(['doctorProfile', 'doctorDocuments']);

        if ($request->boolean('include_deleted')) {
            $query->withTrashed();
        }

        // Filter by verification status (tab)
        if ($request->status === 'pending') {
            $query->where(function($q) {
                $q->whereHas('doctorProfile', function($profileQuery) {
                    $profileQuery->where('verification_status', 'pending');
                })->orDoesntHave('doctorProfile');
            });
        } elseif ($request->status === 'rejected') {
            $query->whereHas('doctorProfile', function($q) {
                $q->where('verification_status', 'rejected');
            });
        } elseif ($request->status === 'approved') {
            $query->whereHas('doctorProfile', function($q) {
                $q->where('verification_status', 'approved');
            });
        }

        // Filter by state/UT (stored in 'city' column for backward compatibility)
        if ($request->has('state') && $request->state) {
            $query->whereHas('doctorProfile', function($q) use ($request) {
                $q->where('city', $request->state);
            });
        }

        // Search by name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $doctors = $query->latest()->paginate(20)->appends($request->query());

        return view('admin.super-admin.doctor-verification', compact('doctors'));
    }

    public function show($id)
    {
        $doctor = User::withTrashed()->with(['doctorProfile', 'doctorDocuments'])->findOrFail($id);

        if (!$doctor->isAdmin()) {
            abort(404);
        }

        return view('admin.super-admin.doctor-detail', compact('doctor'));
    }

    public function approveDoctor($id)
    {
        $doctor = User::findOrFail($id);
        
        if (!$doctor->isAdmin()) {
            abort(404);
        }

        $profile = $doctor->doctorProfile;
        
        if ($profile) {
            $profile->update([
                'verification_status' => 'approved',
                'verified_by' => Auth::id(),
                'verified_at' => now(),
            ]);

            // Approve all documents
            $doctor->doctorDocuments()->update([
                'status' => 'approved',
                'verified_by' => Auth::id(),
                'verified_at' => now(),
            ]);
        }

        return redirect()->route('super-admin.doctor-verification', ['status' => 'approved'])
            ->with('success', 'Doctor approved successfully!');
    }

    public function rejectDoctor(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $doctor = User::findOrFail($id);
        
        if (!$doctor->isAdmin()) {
            abort(404);
        }

        $profile = $doctor->doctorProfile;

        if ($profile) {
            $profile->update([
                'verification_status' => 'rejected',
                'rejection_reason' => $request->rejection_reason,
                'verified_by' => Auth::id(),
                'verified_at' => now(),
            ]);
        } else {
            DoctorProfile::create([
                'user_id' => $doctor->id,
                'verification_status' => 'rejected',
                'rejection_reason' => $request->rejection_reason,
                'verified_by' => Auth::id(),
                'verified_at' => now(),
            ]);
        }

        return redirect()->route('super-admin.doctor-verification', ['status' => 'rejected'])
            ->with('success', 'Doctor rejected.');
    }

    public function approveDocument($documentId)
    {
        $document = DoctorDocument::findOrFail($documentId);
        
        $document->update([
            'status' => 'approved',
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Document approved!');
    }

    public function rejectDocument(Request $request, $documentId)
    {
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $document = DoctorDocument::findOrFail($documentId);
        
        $document->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Document rejected.');
    }

    public function bulkApprove(Request $request)
    {
        $request->validate([
            'doctor_ids' => 'required|array',
            'doctor_ids.*' => 'exists:users,id',
        ]);

        $doctorIds = $request->doctor_ids;
        $approvedCount = 0;

        foreach ($doctorIds as $doctorId) {
            $doctor = User::findOrFail($doctorId);
            
            if (!$doctor->isAdmin()) {
                continue;
            }

            $profile = $doctor->doctorProfile;
            
            if ($profile) {
                $profile->update([
                    'verification_status' => 'approved',
                    'verified_by' => Auth::id(),
                    'verified_at' => now(),
                ]);

                // Approve all documents
                $doctor->doctorDocuments()->update([
                    'status' => 'approved',
                    'verified_by' => Auth::id(),
                    'verified_at' => now(),
                ]);
                
                $approvedCount++;
            }
        }

        return redirect()->back()->with('success', "Successfully approved {$approvedCount} doctor(s)!");
    }

    public function toggleFeatured(Request $request, $id)
    {
        $doctor = User::findOrFail($id);
        
        if (!$doctor->isAdmin()) {
            abort(404);
        }

        $profile = $doctor->doctorProfile;
        
        if (!$profile) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Doctor profile not found.'], 404);
            }
            return redirect()->back()->with('error', 'Doctor profile not found.');
        }

        // Toggle featured status
        $profile->update([
            'is_featured' => !$profile->is_featured,
        ]);

        $status = $profile->is_featured ? 'featured' : 'normal';
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Doctor marked as {$status} successfully!",
                'is_featured' => $profile->is_featured,
                'status_text' => $profile->is_featured ? 'Premium' : 'Normal'
            ]);
        }

        return redirect()->back()->with('success', "Doctor marked as {$status} successfully!");
    }

    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $doctor = User::findOrFail($id);
        
        if (!$doctor->isAdmin()) {
            abort(404);
        }

        $profile = $doctor->doctorProfile;

        if (!$profile) {
            return redirect()->back()->with('error', 'Doctor profile not found.');
        }

        // Delete old photo
        if ($profile->profile_image && \Illuminate\Support\Facades\Storage::disk('public_html')->exists($profile->profile_image)) {
            \Illuminate\Support\Facades\Storage::disk('public_html')->delete($profile->profile_image);
        }

        // Upload new photo
        $path = $request->file('profile_image')->store('doctor_profiles', 'public_html');
        
        $profile->update([
            'profile_image' => $path,
        ]);

        return redirect()->back()->with('success', 'Profile photo updated successfully!');
    }

    public function removePhoto($id)
    {
        $doctor = User::findOrFail($id);
        
        if (!$doctor->isAdmin()) {
            abort(404);
        }

        $profile = $doctor->doctorProfile;

        if (!$profile) {
            return redirect()->back()->with('error', 'Doctor profile not found.');
        }

        if ($profile->profile_image && \Illuminate\Support\Facades\Storage::disk('public_html')->exists($profile->profile_image)) {
            \Illuminate\Support\Facades\Storage::disk('public_html')->delete($profile->profile_image);
            
            $profile->update([
                'profile_image' => null,
            ]);

            return redirect()->back()->with('success', 'Profile photo removed successfully!');
        }

        return redirect()->back()->with('error', 'No profile photo found to remove.');
    }

    public function softDeleteDoctor($id)
    {
        $doctor = User::where('role', 'admin')->findOrFail($id);

        if ($doctor->id === Auth::id()) {
            return redirect()->route('super-admin.doctor-verification', ['status' => 'pending'])
                ->with('error', 'You cannot delete your own account.');
        }

        $doctor->delete();

        return redirect()->route('super-admin.doctor-verification', ['status' => 'pending'])
            ->with('success', 'Doctor has been deleted.');
    }

    public function restoreDoctor($id)
    {
        $doctor = User::onlyTrashed()->where('role', 'admin')->findOrFail($id);
        $doctor->restore();

        return redirect()->back()->with('success', 'Doctor has been restored.');
    }
}

