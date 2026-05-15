<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Driver;
use App\Models\Maintenance;
use App\Models\TripLog;
use App\Models\Vehicle;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Vehicle stats
        $totalVehicles = Vehicle::count();
        $availableVehicles = Vehicle::where('status', 'available')->count();
        $inUseVehicles = Vehicle::where('status', 'in-use')->count();

        // Driver stats
        $totalDrivers = Driver::count();
        $activeDrivers = Driver::where('status', 'active')->count();

        // Trip stats - trips logged in the last 24 hours
        $tripsToday = TripLog::where('departure', '>=', Carbon::now()->subDay())->count();

        // Maintenance stats
        $underMaintenance = Vehicle::where('status', 'maintenance')->count();

        $overdueMaintenance = Maintenance::where('next_due', '<', Carbon::today())
            ->whereNotNull('next_due')
            ->count();

        // Leave Requests
        $leaveRequests = LeaveRequest::all();

        // Trips per vehicle for chart
        $tripsPerVehicle = TripLog::selectRaw('vehicle, COUNT(*) as trip_count')
            ->groupBy('vehicle')
            ->get();

        // Alerts - License expiring (within 30 days)
        $expiringLicenses = Driver::where('license_expiry', '<=', Carbon::now()->addDays(30))
            ->where('license_expiry', '>=', Carbon::today())
            ->orderBy('license_expiry')
            ->get();

        // Alerts - Maintenance due
        $maintenanceDue = Maintenance::with('vehicle')
            ->whereNotNull('next_due')
            ->where('next_due', '<=', Carbon::today())
            ->orderBy('next_due')
            ->get();

        return view('dashboard', compact(
            'leaveRequests',
            'totalVehicles',
            'availableVehicles',
            'inUseVehicles',
            'totalDrivers',
            'activeDrivers',
            'tripsToday',
            'underMaintenance',
            'overdueMaintenance',
            'tripsPerVehicle',
            'expiringLicenses',
            'maintenanceDue'
        ));
    }
}