@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="app-shell">
    <aside class="sidebar">
        <div class="sidebar-card">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9" /><path d="M12 3v9h9" /></svg>
                </div>
                <div class="sidebar-brand-copy">
                    <div class="sidebar-brand-title">FleetOps</div>
                    <div class="sidebar-brand-subtitle">Console</div>
                </div>
            </div>
            @php $current = Route::currentRouteName(); @endphp
            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ $current === 'dashboard' ? 'active' : '' }}">
                    <span class="sidebar-link-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                    </span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('vehicles.index') }}" class="sidebar-link {{ $current === 'vehicles.index' ? 'active' : '' }}">
                    <span class="sidebar-link-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M5 17H3v-6l2-5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0H9"/></svg>
                    </span>
                    <span>Vehicles</span>
                </a>
                <a href="{{ route('drivers.index') }}" class="sidebar-link {{ $current === 'drivers.index' ? 'active' : '' }}">
                    <span class="sidebar-link-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" /></svg>
                    </span>
                    <span>Drivers</span>
                </a>
                <a href="{{ route('trip-logs.index') }}" class="sidebar-link {{ $current === 'trip-logs.index' ? 'active' : '' }}">
                    <span class="sidebar-link-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="2"/><path d="M9 14l2 2 4-4"/></svg>
                    </span>
                    <span>Trip Logs</span>
                </a>
                <a href="{{ route('maintenance.index') }}" class="sidebar-link {{ $current === 'maintenance.index' ? 'active' : '' }}">
                    <span class="sidebar-link-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </span>
                    <span>Maintenance</span>
                </a>
                <a href="{{ route('reports') }}" class="sidebar-link {{ $current === 'reports' ? 'active' : '' }}">
                    <span class="sidebar-link-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
                    </span>
                    <span>Reports</span>
                </a>
            </nav>
        </div>

        <div class="sidebar-card sidebar-footer">
            <div class="sidebar-footer-title">{{ auth()->user()->name }}</div>
            <div class="sidebar-footer-subtitle">{{ auth()->user()->email }}</div>
            @if(auth()->user()->role)
                <div class="sidebar-role-badge">{{ auth()->user()->role->name }}</div>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-signout-button">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><polyline points="16 17 21 12 16 7" /><line x1="21" y1="12" x2="9" y2="12" /></svg>
                    Sign out
                </button>
            </form>
        </div>
    </aside>

    <div class="dashboard-main">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Operations overview</h1>
            <p class="dashboard-subtitle">Live snapshot of your fleet status, drivers and upcoming actions.</p>
        </div>

        <div class="metric-grid">
            <article class="metric-card">
                <div class="metric-top">
                    <div class="metric-label">Total vehicles</div>
                    <div class="metric-icon metric-icon--blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M5 17H3v-6l2-5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0H9"/></svg>
                    </div>
                </div>
                <div class="metric-value">{{ $totalVehicles }}</div>
                <div class="metric-note">{{ $availableVehicles }} available · {{ $inUseVehicles }} in-use</div>
            </article>
            <article class="metric-card">
                <div class="metric-top">
                    <div class="metric-label">Active drivers</div>
                    <div class="metric-icon metric-icon--amber">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
                <div class="metric-value">{{ $activeDrivers }}/{{ $totalDrivers }}</div>
                <div class="metric-note">active out of total</div>
            </article>
            <article class="metric-card">
                <div class="metric-top">
                    <div class="metric-label">Trips today</div>
                    <div class="metric-icon metric-icon--green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                </div>
                <div class="metric-value">{{ $tripsToday }}</div>
                <div class="metric-note">logged in last 24 hours</div>
            </article>
            <article class="metric-card">
                <div class="metric-top">
                    <div class="metric-label">Under maintenance</div>
                    <div class="metric-icon metric-icon--red">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                </div>
                <div class="metric-value">{{ $underMaintenance }}</div>
                <div class="metric-note">{{ $overdueMaintenance }} overdue alert{{ $overdueMaintenance !== 1 ? 's' : '' }}</div>
            </article>
        </div>

        <div class="charts-grid">
            <section class="content-card chart-panel">
                <div class="chart-header">
                    <h2 class="chart-title">Trips per vehicle</h2>
                    <p class="chart-subtitle">Distance and frequency by plate</p>
                </div>
                @if ($tripsPerVehicle->isEmpty())
                    <div class="chart-empty">No trip data recorded yet.</div>
                @else
                    @php
                        $maxTrips = $tripsPerVehicle->max('trip_count') ?: 1;
                        // Round up to next nice number for y-axis
                        $yMax = ceil($maxTrips / 50) * 50;
                        if ($yMax < 50) $yMax = max($maxTrips + 5, 10);
                    @endphp
                    <div class="bar-chart-container">
                        <div class="bar-chart-y-axis">
                            @for ($i = 4; $i >= 0; $i--)
                                <span>{{ round($yMax / 4 * $i) }}</span>
                            @endfor
                        </div>
                        <div class="bar-chart-area">
                            <div class="bar-chart-grid-lines">
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="bar-chart-grid-line"></div>
                                @endfor
                            </div>
                            <div class="bar-chart-bars">
                                @foreach ($tripsPerVehicle as $trip)
                                    @php $barHeight = ($trip->trip_count / $yMax) * 100; @endphp
                                    <div class="bar-chart-bar-group">
                                        <div class="bar-chart-bar-wrapper">
                                            <div class="bar-chart-bar" style="height: {{ $barHeight }}%">
                                                <span class="bar-chart-tooltip">{{ $trip->trip_count }}</span>
                                            </div>
                                        </div>
                                        <span class="bar-chart-label">{{ $trip->vehicle }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </section>

            <aside class="content-card alert-panel">
                <h2 class="alert-panel-title">Alerts</h2>

                {{-- License Expiring Alerts --}}
                @if ($expiringLicenses->isNotEmpty())
                    <div class="alert-section">
                        <div class="alert-section-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
                            License expiring
                        </div>
                        @foreach ($expiringLicenses as $driver)
                            <div class="alert-item">
                                <span class="alert-item-name">{{ $driver->name }}</span>
                                <span class="alert-item-date alert-item-date--blue">{{ $driver->license_expiry->format('Y-m-d') }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Maintenance Due Alerts --}}
                @if ($maintenanceDue->isNotEmpty())
                    <div class="alert-section">
                        <div class="alert-section-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            Maintenance due
                        </div>
                        @foreach ($maintenanceDue as $maint)
                            <div class="alert-item-block">
                                <div class="alert-item">
                                    <span class="alert-item-name">{{ $maint->vehicle ? $maint->vehicle->plate_number : 'N/A' }}</span>
                                    <span class="alert-item-type">{{ $maint->type }}</span>
                                </div>
                                <div class="alert-item-overdue">Due on {{ $maint->next_due->format('Y-m-d') }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($expiringLicenses->isEmpty() && $maintenanceDue->isEmpty())
                    <div class="alert-empty">No alerts at this time.</div>
                @endif
            </aside>
        </div>
    </div>
</div>
@endsection
