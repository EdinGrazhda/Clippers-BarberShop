<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarbersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Barber::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $status = $request->get('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Experience filter
        if ($request->filled('experience')) {
            $experience = $request->get('experience');
            switch ($experience) {
                case '0-5':
                    $query->whereBetween('experience_years', [0, 5]);
                    break;
                case '6-10':
                    $query->whereBetween('experience_years', [6, 10]);
                    break;
                case '11-15':
                    $query->whereBetween('experience_years', [11, 15]);
                    break;
                case '16+':
                    $query->where('experience_years', '>=', 16);
                    break;
            }
        }

        $barbers = $query->latest()->paginate(7)->withQueryString();
        
        return view('admin.barbers.index', compact('barbers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:barbers,email',
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:500',
            'experience_years' => 'required|integer|min:0|max:50',
            'specialties' => 'nullable|array',
            'specialties.*' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('barbers', 'public');
        }

        // Clean up specialties - remove empty values
        if (isset($validated['specialties'])) {
            $validated['specialties'] = array_filter($validated['specialties'], function($specialty) {
                return !empty(trim($specialty));
            });
            $validated['specialties'] = array_values($validated['specialties']); // Re-index array
        }

        // Handle checkbox - convert to boolean
        $validated['is_active'] = $request->input('is_active', 0) == '1';

        Barber::create($validated);

        return redirect()->route('barbers.index', ['page' => 1])
            ->with('success', 'Barber created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barber $barber)
    {
        return response()->json($barber);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barber $barber)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:barbers,email,' . $barber->id,
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:500',
            'experience_years' => 'required|integer|min:0|max:50',
            'specialties' => 'nullable|array',
            'specialties.*' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($barber->image) {
                Storage::disk('public')->delete($barber->image);
            }
            $validated['image'] = $request->file('image')->store('barbers', 'public');
        }

        // Clean up specialties - remove empty values
        if (isset($validated['specialties'])) {
            $validated['specialties'] = array_filter($validated['specialties'], function($specialty) {
                return !empty(trim($specialty));
            });
            $validated['specialties'] = array_values($validated['specialties']); // Re-index array
        }

        // Handle checkbox - convert to boolean
        $validated['is_active'] = $request->input('is_active', 0) == '1';

        $barber->update($validated);

        return redirect()->route('barbers.index')
            ->with('success', 'Barber updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barber $barber)
    {
        // Delete image if exists
        if ($barber->image) {
            Storage::disk('public')->delete($barber->image);
        }

        $barber->delete();

        return redirect()->route('barbers.index')
            ->with('success', 'Barber deleted successfully!');
    }
}