<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('plate_number')->get();

        return view('vehicles.index', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'plate_number' => 'required|string|max:255|unique:vehicles,plate_number',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2100',
            'color' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|string|max:255',
            'status' => 'required|string|in:Available,In use,Maintenance,Inactive',
            'odometer' => 'required|integer|min:0',
            'maintenance_interval' => 'required|integer|min:0',
            'assigned_driver' => 'nullable|string|max:255',
        ]);

        Vehicle::create($data);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function edit(Vehicle $vehicle)
    {
        return response()->json($vehicle);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'plate_number' => 'required|string|max:255|unique:vehicles,plate_number,' . $vehicle->id,
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2100',
            'color' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|string|max:255',
            'status' => 'required|string|in:Available,In use,Maintenance,Inactive',
            'odometer' => 'required|integer|min:0',
            'maintenance_interval' => 'required|integer|min:0',
            'assigned_driver' => 'nullable|string|max:255',
        ]);

        $vehicle->update($data);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
