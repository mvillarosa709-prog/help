<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenance = Maintenance::with('vehicle')
            ->orderBy('date', 'desc')
            ->get();

        $vehicles = Vehicle::all();

        return view('maintenance.index', compact('maintenance', 'vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'type' => 'required|string',
            'date' => 'required|date',
            'cost' => 'required|numeric|min:0',
            'next_due' => 'nullable|date',
            'next_due_km' => 'nullable|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        Maintenance::create($validated);

        return redirect()->route('maintenance.index')->with('success', 'Maintenance record added successfully.');
    }

    public function show(Maintenance $maintenance)
    {
        return response()->json($maintenance);
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'type' => 'required|string',
            'date' => 'required|date',
            'cost' => 'required|numeric|min:0',
            'next_due' => 'nullable|date',
            'next_due_km' => 'nullable|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        $maintenance->update($validated);

        return redirect()->route('maintenance.index')->with('success', 'Maintenance record updated successfully.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('maintenance.index')->with('success', 'Maintenance record deleted successfully.');
    }
}

