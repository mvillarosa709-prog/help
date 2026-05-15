<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::orderBy('name')->get();

        return view('drivers.index', compact('drivers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'license_expiry' => 'required|date',
            'contact' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'assigned_vehicle' => 'nullable|string|max:255',
            'status' => 'required|string|in:Active,Inactive,On leave,Suspended',
        ]);

        Driver::create($data);

        return redirect()->route('drivers.index')->with('success', 'Driver created successfully.');
    }

    public function edit(Driver $driver)
    {
        return response()->json($driver);
    }

    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'license_expiry' => 'required|date',
            'contact' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'assigned_vehicle' => 'nullable|string|max:255',
            'status' => 'required|string|in:Active,Inactive,On leave,Suspended',
        ]);

        $driver->update($data);

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }
}
