<?php

namespace App\Http\Controllers;

use App\Models\TripLog;
use Illuminate\Http\Request;

class TripLogController extends Controller
{
    public function index()
    {
        $tripLogs = TripLog::orderBy('departure', 'desc')->get();

        return view('trip_logs.index', compact('tripLogs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vehicle' => 'required|string|max:255',
            'driver' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'departure' => 'required|date_format:Y-m-d\TH:i',
            'return' => 'nullable|date_format:Y-m-d\TH:i|after:departure',
            'odometer_start' => 'required|integer|min:0',
            'odometer_end' => 'required|integer|min:0|gte:odometer_start',
        ]);

        $data['distance'] = $data['odometer_end'] - $data['odometer_start'];

        TripLog::create($data);

        return redirect()->route('trip-logs.index')->with('success', 'Trip logged successfully.');
    }

    public function edit(TripLog $tripLog)
    {
        return view('trip_logs.edit', compact('tripLog'));
    }
public function update(Request $request, $id)
{
    $tripLog = TripLog::findOrFail($id);

    $data = $request->validate([
        'vehicle' => 'required|string|max:255',
        'driver' => 'required|string|max:255',
        'destination' => 'required|string|max:255',
        'purpose' => 'required|string|max:255',
        'departure' => 'required',
        'return' => 'nullable',
        'odometer_start' => 'required|integer|min:0',
        'odometer_end' => 'required|integer|min:0|gte:odometer_start',
    ]);

    $data['distance'] = $data['odometer_end'] - $data['odometer_start'];

    $tripLog->update($data);

    return redirect()->route('trip-logs.index')
        ->with('success', 'Trip updated successfully.');
}

    public function destroy(TripLog $tripLog)
    {
        $tripLog->delete();

        return redirect()->route('trip-logs.index')->with('success', 'Trip deleted successfully.');
    }
}
