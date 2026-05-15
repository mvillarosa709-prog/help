<?php

namespace App\Http\Controllers;

use App\Models\TripLog;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;

class TripLogController extends Controller
{
    public function index()
    {
        // Load all trip logs
        $trips = TripLog::latest()->get();

        // Load vehicles & drivers for dropdowns
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('triplogs.index', compact('trips', 'vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle' => 'required|string|max:255',
            'driver' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'notes' => 'nullable|string',
        ]);

        TripLog::create([
            'vehicle' => $request->vehicle,
            'driver' => $request->driver,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('trip-logs.index')->with('success', 'Trip logged successfully.');
    }
}
