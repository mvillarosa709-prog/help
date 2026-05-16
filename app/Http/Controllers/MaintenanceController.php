<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenance = Maintenance::with('vehicle')->latest()->get();
        $vehicles = Vehicle::all();

        return view('maintenance.index', compact('maintenance', 'vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'type' => 'required|string',
            'date' => 'required|date',
            'cost' => 'required|numeric',
            'next_due' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        Maintenance::create($validated);

        return back()->with('success', 'Added successfully');
    }

    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'type' => 'required|string',
            'date' => 'required|date',
            'cost' => 'required|numeric',
            'next_due' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        $maintenance->update($validated);

        return back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        Maintenance::findOrFail($id)->delete();

        return back()->with('success', 'Deleted successfully');
    }
}