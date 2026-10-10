<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Content;
use App\Models\Post;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_patients' => User::where('role', 'patient')->count(),
            'total_doctors' => User::where('role', 'admin')->count(),
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'total_posts' => Post::count(),
        ];

        $recent_appointments = Appointment::with([
            'patient' => fn ($q) => $q->withTrashed(),
            'doctor' => fn ($q) => $q->withTrashed(),
        ])->latest()->take(10)->get();

        return view('admin.super-admin.dashboard', compact('stats', 'recent_appointments'));
    }

    public function manageUsers(Request $request)
    {
        $users = User::latest()->paginate(20);
        return view('admin.super-admin.users', compact('users'));
    }

    /**
     * Developer-only page: restore soft-deleted users and doctors.
     * Not linked from the admin panel — bookmark the URL for internal use.
     */
    public function developerRestore()
    {
        $deletedUsers = User::onlyTrashed()->orderBy('deleted_at', 'desc')->limit(100)->get();
        $deletedDoctors = User::onlyTrashed()->where('role', 'admin')->orderBy('deleted_at', 'desc')->limit(100)->get();
        return view('admin.super-admin.developer-restore', compact('deletedUsers', 'deletedDoctors'));
    }

    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:super_admin,admin,patient',
        ]);

        $user = User::withTrashed()->findOrFail($id);
        if ($user->trashed()) {
            return redirect()->back()->with('error', 'Cannot update role of a deleted account. Restore the user first.');
        }
        $user->update(['role' => $request->role]);

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function softDeleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }
        if ($user->isSuperAdmin()) {
            $superAdminCount = User::where('role', 'super_admin')->count();
            if ($superAdminCount <= 1) {
                return redirect()->back()->with('error', 'Cannot delete the last Super Admin.');
            }
        }
        $user->delete();
        return redirect()->back()->with('success', 'User has been deleted.');
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->back()->with('success', 'User has been restored.');
    }

    public function appointments(Request $request)
    {
        $query = Appointment::with([
            'patient' => fn ($q) => $q->withTrashed(),
            'doctor' => fn ($q) => $q->withTrashed(),
        ]);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by patient or doctor name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('patient', function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('doctor', function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        $appointments = $query->latest()->paginate(20);

        $stats = [
            'total' => Appointment::count(),
            'pending' => Appointment::where('status', 'pending')->count(),
            'confirmed' => Appointment::where('status', 'confirmed')->count(),
            'completed' => Appointment::where('status', 'completed')->count(),
            'cancelled' => Appointment::where('status', 'cancelled')->count(),
        ];

        return view('admin.super-admin.appointments', compact('appointments', 'stats'));
    }
}

