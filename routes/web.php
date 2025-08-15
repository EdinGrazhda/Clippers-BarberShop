<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BarbersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicBookingController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicBookingController::class, 'index'])->name('home');

 Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('auth');


// Booking routes
Route::post('/book', [PublicBookingController::class, 'store'])->name('book');
Route::get('/available-slots', [PublicBookingController::class, 'getAvailableSlots'])->name('available-slots');
Route::post('/send-verification', [PublicBookingController::class, 'sendVerification'])->name('send-verification');
Route::post('/verify-code', [PublicBookingController::class, 'verifyCode'])->name('verify-code');

// Admin routes
Route::middleware(['auth'])->group(function () {

   

    Route::resource('barbers', BarbersController::class);
    Route::resource('appointments', AppointmentController::class);
    
    // Calendar route
    Route::get('calendar', function () {
        return view('Admin.calendar.index');
    })->name('calendar.index');
    
    // API endpoint for calendar appointments
    Route::get('api/appointments', [AppointmentController::class, 'getCalendarAppointments'])->name('api.appointments');
    
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
