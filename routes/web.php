<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PhysiotherapistController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PublicMediaController;

Route::get('/media/{path}', [PublicMediaController::class, 'show'])
    ->where('path', '.*')
    ->name('media.public');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{categorySlug}/{subcategorySlug}', [ServiceController::class, 'showSubservice'])->name('services.subservice');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/treatments', [HomeController::class, 'treatments'])->name('treatments');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

// Doctors Routes
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{slug}', [DoctorController::class, 'show'])->name('doctors.show');

// ── Doctor Appointment Booking Flow ─────────────────────────────────────────
Route::get('/book-appointment', [BookingController::class, 'index'])->name('book-appointment');
Route::get('/book-appointment/confirmation/{id}', [BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::get('/book-appointment/{slug}', [BookingController::class, 'showDoctor'])->name('booking.doctor');
Route::post('/book-appointment/{slug}/book', [BookingController::class, 'store'])->name('booking.store');

// AJAX Endpoints (booking)
Route::get('/api/booking/doctors', [BookingController::class, 'getDoctors'])->name('api.booking.doctors');
Route::get('/api/booking/slots', [BookingController::class, 'getSlots'])->name('api.booking.slots');

// Physiotherapist Registration Routes (Legacy - redirect to new flow)
Route::get('/register-physiotherapist', function() {
    return redirect()->route('doctor.registration.step1');
})->name('register-physiotherapist');

// Doctor Registration Routes (Multi-step)
Route::prefix('doctor/register')->name('doctor.registration.')->group(function () {
    // Step 1 - Only accessible by guests (new registrations)
    Route::middleware('guest')->group(function () {
        Route::get('/step1', [App\Http\Controllers\Doctor\RegistrationController::class, 'step1'])->name('step1');
        Route::post('/step1', [App\Http\Controllers\Doctor\RegistrationController::class, 'storeStep1'])->name('store.step1');
    });
    
    // Steps 2-4 and Complete - Require authentication
    Route::middleware('auth')->group(function () {
        Route::get('/step2', [App\Http\Controllers\Doctor\RegistrationController::class, 'step2'])->name('step2');
        Route::post('/step2', [App\Http\Controllers\Doctor\RegistrationController::class, 'storeStep2'])->name('store.step2');
        Route::get('/step3', [App\Http\Controllers\Doctor\RegistrationController::class, 'step3'])->name('step3');
        Route::post('/step3', [App\Http\Controllers\Doctor\RegistrationController::class, 'storeStep3'])->name('store.step3');
        Route::get('/step4', [App\Http\Controllers\Doctor\RegistrationController::class, 'step4'])->name('step4');
        Route::post('/step4', [App\Http\Controllers\Doctor\RegistrationController::class, 'storeStep4'])->name('store.step4');
        Route::get('/complete', [App\Http\Controllers\Doctor\RegistrationController::class, 'complete'])->name('complete');
        Route::get('/subcategories', [App\Http\Controllers\Doctor\RegistrationController::class, 'subcategoriesByCategory'])->name('subcategories');
    });
});

// Authentication Routes - Only accessible by guests
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
    
    // Password Reset Routes
    Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendOTP'])->name('password.send-otp');
    Route::get('/verify-otp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showVerifyOTPForm'])->name('password.verify-otp');
    Route::post('/verify-otp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'verifyOTP'])->name('password.verify-otp');
    Route::post('/resend-otp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'resendOTP'])->name('password.resend-otp');
    Route::get('/reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'resetPassword'])->name('password.reset');
});

// Logout - Requires authentication
Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
