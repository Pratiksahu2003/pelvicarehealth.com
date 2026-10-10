<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\PostController;

// Admin Dashboard - Redirects based on role
Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

// Super Admin Routes
Route::middleware(['auth', 'role:super_admin'])->prefix('admin/super-admin')->name('super-admin.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [SuperAdminController::class, 'manageUsers'])->name('users');
    Route::post('/users/{id}/role', [SuperAdminController::class, 'updateUserRole'])->name('users.update-role');
    Route::post('/users/{id}/soft-delete', [SuperAdminController::class, 'softDeleteUser'])->name('users.soft-delete');
    Route::post('/users/{id}/restore', [SuperAdminController::class, 'restoreUser'])->name('users.restore');
    // Developer-only: restore deleted users/doctors (no link in panel)
    Route::get('/developer/restore', [SuperAdminController::class, 'developerRestore'])->name('developer.restore');
    
    // Appointments Management
    Route::get('/appointments', [SuperAdminController::class, 'appointments'])->name('appointments');
    
    // Doctor Verification
    Route::get('/doctor-verification', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'index'])->name('doctor-verification');
    Route::get('/doctor-verification/{id}', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'show'])->name('doctor-verification.show');
    Route::post('/doctor-verification/bulk-approve', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'bulkApprove'])->name('doctor-verification.bulk-approve');
    Route::post('/doctor-verification/{id}/approve', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'approveDoctor'])->name('doctor-verification.approve');
    Route::post('/doctor-verification/{id}/reject', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'rejectDoctor'])->name('doctor-verification.reject');
    Route::post('/doctor-verification/{id}/toggle-featured', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'toggleFeatured'])->name('doctor-verification.toggle-featured');
    Route::post('/doctor-verification/{id}/soft-delete', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'softDeleteDoctor'])->name('doctor-verification.soft-delete');
    Route::post('/doctor-verification/{id}/restore', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'restoreDoctor'])->name('doctor-verification.restore');
    Route::post('/doctor-verification/document/{id}/approve', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'approveDocument'])->name('doctor-verification.document.approve');
    Route::post('/doctor-verification/document/{id}/reject', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'rejectDocument'])->name('doctor-verification.document.reject');
    Route::post('/doctor-verification/{id}/photo', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'updatePhoto'])->name('doctor-verification.photo.update');
    Route::delete('/doctor-verification/{id}/photo', [App\Http\Controllers\Admin\DoctorVerificationController::class, 'removePhoto'])->name('doctor-verification.photo.remove');
});

// Content Management (Super Admin only)
Route::middleware(['auth', 'role:super_admin'])->prefix('admin/content')->name('admin.content.')->group(function () {
    Route::get('/', [ContentController::class, 'index'])->name('index');
    Route::get('/create', [ContentController::class, 'create'])->name('create');
    Route::post('/', [ContentController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ContentController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ContentController::class, 'update'])->name('update');
    Route::delete('/{id}', [ContentController::class, 'destroy'])->name('destroy');
});

// Service Categories & Subcategories (Super Admin only)
Route::middleware(['auth', 'role:super_admin'])->prefix('admin/service-categories')->name('admin.service-categories.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'destroy'])->name('destroy');
});
Route::middleware(['auth', 'role:super_admin'])->prefix('admin/service-subcategories')->name('admin.service-subcategories.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\ServiceSubcategoryController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Admin\ServiceSubcategoryController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\Admin\ServiceSubcategoryController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [App\Http\Controllers\Admin\ServiceSubcategoryController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\Admin\ServiceSubcategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\Admin\ServiceSubcategoryController::class, 'destroy'])->name('destroy');
});

// Blog Management (Super Admin only)
Route::middleware(['auth', 'role:super_admin'])->prefix('admin/blog')->name('admin.blog.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('upload-image');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
    Route::delete('/{postId}/images/{imageId}', [PostController::class, 'destroyPostImage'])->name('images.destroy');
});

// Doctor/Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin/doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('dashboard');
    Route::get('/appointments', [DoctorController::class, 'appointments'])->name('appointments');
    Route::post('/appointments/{id}/status', [DoctorController::class, 'updateAppointmentStatus'])->name('appointments.update-status');
    Route::get('/availability', [DoctorController::class, 'availability'])->name('availability');
    Route::post('/availability', [DoctorController::class, 'storeAvailability'])->name('availability.store');
    Route::delete('/availability/{id}', [DoctorController::class, 'deleteAvailability'])->name('availability.delete');
    Route::get('/profile', [DoctorController::class, 'profile'])->name('profile');
    Route::post('/profile', [DoctorController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/photo', [DoctorController::class, 'updateProfilePhoto'])->name('profile.photo.update');
    Route::post('/profile/upload-image', [DoctorController::class, 'uploadImage'])->name('upload-image');
    Route::post('/profile/faqs', [DoctorController::class, 'storeFaq'])->name('faqs.store');
    Route::put('/profile/faqs/{id}', [DoctorController::class, 'updateFaq'])->name('faqs.update');
    Route::delete('/profile/faqs/{id}', [DoctorController::class, 'destroyFaq'])->name('faqs.destroy');
    Route::post('/profile/photos', [DoctorController::class, 'storePhotos'])->name('photos.store');
    Route::delete('/profile/photos/{id}', [DoctorController::class, 'destroyPhoto'])->name('photos.destroy');
    Route::put('/password', [DoctorController::class, 'updatePassword'])->name('password.update');
    Route::post('/profile/document/{id}/reupload', [DoctorController::class, 'reuploadDocument'])->name('profile.document.reupload');
});

// Patient Routes
Route::middleware(['auth', 'role:patient'])->prefix('admin/patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\Patient\ProfileController::class, 'edit'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\Patient\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [App\Http\Controllers\Patient\ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/documents', [App\Http\Controllers\Patient\ProfileController::class, 'uploadDocument'])->name('documents.upload');
    Route::delete('/documents/{id}', [App\Http\Controllers\Patient\ProfileController::class, 'deleteDocument'])->name('documents.delete');
    Route::get('/appointments', [PatientController::class, 'appointments'])->name('appointments');
    Route::get('/appointments/book', [PatientController::class, 'bookAppointment'])->name('appointments.book');
    Route::post('/appointments', [PatientController::class, 'storeAppointment'])->name('appointments.store');
    Route::get('/appointments/{id}/rebook', [PatientController::class, 'rebookAppointment'])->name('appointments.rebook');
    Route::post('/appointments/{id}/rebook', [PatientController::class, 'storeRebookAppointment'])->name('appointments.rebook.store');
    Route::get('/reports', [PatientController::class, 'reports'])->name('reports');
    Route::get('/reports/{id}', [PatientController::class, 'viewReport'])->name('reports.view');
});

