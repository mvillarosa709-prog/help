<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    // SHOW ALL VEHICLES
    public function index()
    {
<<<<<<< HEAD
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
=======
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
>>>>>>> 200274370182e3840f446231f00f9bfa74bbfca8
    }

    // SHOW CREATE FORM
    public function create()
    {
        return view('vehicles.create');
    }

    // STORE NEW VEHICLE
    public function store(Request $request)
    {
        Vehicle::create([
            'plate_number' => $request->plate_number,
            'model' => $request->model,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect('/vehicles')->with('success', 'Vehicle added successfully!');
    }

    // SHOW EDIT FORM
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    // UPDATE VEHICLE
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->update([
            'plate_number' => $request->plate_number,
            'model' => $request->model,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect('/vehicles')->with('success', 'Vehicle updated successfully!');
    }

    // DELETE VEHICLE
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect('/vehicles')->with('success', 'Vehicle deleted successfully!');
    }
}