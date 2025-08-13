<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Barber;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Appointment::with('barber');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhereHas('barber', function ($barberQuery) use ($search) {
                      $barberQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        // Barber filter
        if ($request->filled('barber_id')) {
            $query->where('barber_id', $request->get('barber_id'));
        }

        // Date filter
        if ($request->filled('date')) {
            $query->whereDate('appointment_time', $request->get('date'));
        }

        $appointments = $query->latest()->paginate(10)->withQueryString();
        $barbers = Barber::where('is_active', true)->orderBy('name')->get();
        
        return view('Admin.appointment.index', compact('appointments', 'barbers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'appointment_time' => 'required|date|after:now',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        Appointment::create($validated);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load('barber');
        return response()->json($appointment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'appointment_time' => 'required|date',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully!');
    }
}
