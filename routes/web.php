<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Simple booking handler
Route::post('/book', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'phone' => ['required', 'string', 'max:60'],
        'email' => ['nullable', 'email'],
        'service' => ['required', 'string', 'max:60'],
        'date' => ['required', 'date'],
        'time' => ['required'],
        'notes' => ['nullable', 'string', 'max:500'],
    ]);

    // You can persist $validated to DB or send a notification here.
    return back()->with('status', 'Thanks, ' . $validated['name'] . '. Your ' . $validated['service'] . ' on ' . $validated['date'] . ' at ' . $validated['time'] . ' has been requested. We\'ll confirm shortly.');
})->name('book');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
