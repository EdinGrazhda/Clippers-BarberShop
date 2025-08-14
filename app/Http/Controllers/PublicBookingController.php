<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Barber;
use App\Enums\Status;
use Illuminate\Support\Facades\Auth;

class PublicBookingController extends Controller
{
    /**
     * Show the public booking page
     */
    public function index()
    {
        $barbers = Barber::where('is_active', true)->get();
        return view('welcome', compact('barbers'));
    }

    /**
     * Store a new appointment booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:255',
            'barber_id' => 'required|exists:barbers,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|string',
            'services' => 'required|array|min:1',
            'services.*' => 'string',
        ]);

        // Check if the time slot is already taken
        $existingAppointment = Appointment::where('barber_id', $request->barber_id)
            ->whereDate('appointment_time', $request->appointment_date)
            ->whereTime('appointment_time', $request->appointment_time)
            ->first();

        if ($existingAppointment) {
            return back()->withErrors(['appointment_time' => 'This time slot is already taken. Please select another time.'])->withInput();
        }

        Appointment::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'barber_id' => $request->barber_id,
            'appointment_time' => $request->appointment_date . ' ' . $request->appointment_time,
            'service' => implode(', ', $request->services),
            'status' => Status::CONFIRMED,
        ]);

        // Redirect to appointments page if user is authenticated, otherwise back to welcome page
        if (Auth::check()) {
            return redirect()->route('appointments.index')->with('success', 'Your appointment has been confirmed successfully! You can view it in the appointments section.');
        }

        return back()->with('success', 'Your appointment has been confirmed successfully!');
    }

    /**
     * Get available time slots for a specific barber and date
     */
    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'date' => 'required|date',
        ]);

        // Define working hours (9 AM to 6 PM, 1-hour slots)
        $workingHours = [
            '09:00', '10:00', '11:00', '12:00', 
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
        ];

        // Get already booked slots for this barber on this date
        $bookedSlots = Appointment::where('barber_id', $request->barber_id)
            ->whereDate('appointment_time', $request->date)
            ->pluck('appointment_time')
            ->map(function ($time) {
                return \Carbon\Carbon::parse($time)->format('H:i');
            })
            ->toArray();

        // Filter out booked slots
        $availableSlots = array_diff($workingHours, $bookedSlots);

        return response()->json([
            'available_slots' => array_values($availableSlots)
        ]);
    }
}
