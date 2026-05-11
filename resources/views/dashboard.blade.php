@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
    $totalRequests = $leaveRequests->count();
    $approvedRequests = $leaveRequests->where('status', 'approved')->count();
    $pendingRequests = $leaveRequests->where('status', 'pending')->count();
    $rejectedRequests = $leaveRequests->where('status', 'rejected')->count();
    $upcomingRequest = $leaveRequests->where('start_date', '>=', now()->toDateString())->sortBy('start_date')->first();
    $typeGroups = $leaveRequests->groupBy('type');
    $maxTypeCount = $typeGroups->max(fn($group) => $group->count()) ?: 1;
@endphp

<div class="app-shell">
    <aside class="sidebar">
        <div class="sidebar-card">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9" /><path d="M12 3v9h9" /></svg>
                </div>
                <div>
                    <p class="sidebar-brand-title">FleetOps</p>
                    <p class="sidebar-brand-subtitle">Console</p>
                </div>
            </div>

            @php $current = Route::currentRouteName(); @endphp
            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ $current === 'dashboard' ? 'active' : '' }}">
                    <span class="sidebar-link-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h18" /><path d="M12 3v18" /></svg>
                    </span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('vehicles.index') }}" class="sidebar-link {{ $current === 'vehicles.index' ? 'active' : '' }}">
                    <span class="sidebar-link-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 13l2-5h13l2 5" /><path d="M5 18h14" /><circle cx="7.5" cy="18.5" r="1.5" /><circle cx="16.5" cy="18.5" r="1.5" /></svg>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7h8" /><path d="M8 12h8" /><path d="M8 17h8" /><path d="M5 4h14" /><path d="M5 20h14" /></svg>
                    </span>
                    <span>Trip Logs</span>
                </a>
                <a href="{{ route('maintenance.index') }}" class="sidebar-link {{ $current === 'maintenance.index' ? 'active' : '' }}">
                    <span class="sidebar-link-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1l2 5h5l-4 3 2 5-4-3-4 3 2-5-4-3h5z" /></svg>
                    </span>
                    <span>Maintenance</span>
                </a>
                <a href="#" class="sidebar-link {{ $current === 'reports' ? 'active' : '' }}">
                    <span class="sidebar-link-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19h16" /><path d="M7 15v4" /><path d="M12 11v8" /><path d="M17 7v12" /></svg>
                    </span>
                    <span>Reports</span>
                </a>
            </nav>
        </div>

        <div class="sidebar-card sidebar-footer">
            <div class="sidebar-footer-title">Fleet Manager</div>
            <div class="sidebar-footer-subtitle">{{ auth()->user()->name }}</div>
            <div class="sidebar-footer-subtitle">{{ auth()->user()->email }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-footer-button">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><polyline points="16 17 21 12 16 7" /><line x1="21" y1="12" x2="9" y2="12" /></svg>
                    Sign out
                </button>
            </form>
        </div>
    </aside>

    <div>
        <div style="margin-bottom: 2rem;">
            <h1 style="margin: 0 0 0.5rem 0; font-size: 1.75rem; color: #0f172a;">Operations overview</h1>
            <p style="margin: 0; color: #64748b; font-size: 0.95rem;">Live snapshot of your fleet status, drivers and upcoming actions.</p>
        </div>

        <div class="metric-grid">
            <article class="metric-card">
                <div class="metric-label">Total vehicles</div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-top: 1rem;">
                    <div class="metric-value">4</div>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 2rem; height: 2rem; color: #cbd5e1;"><path d="M3 13l2-5h13l2 5" /><path d="M5 18h14" /><circle cx="7.5" cy="18.5" r="1.5" /><circle cx="16.5" cy="18.5" r="1.5" /></svg>
                </div>
                <div class="metric-note">2 available · 1 in-use</div>
            </article>
            <article class="metric-card">
                <div class="metric-label">Active drivers</div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-top: 1rem;">
                    <div class="metric-value">2/3</div>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 2rem; height: 2rem; color: #cbd5e1;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" /></svg>
                </div>
                <div class="metric-note">active out of total</div>
            </article>
            <article class="metric-card">
                <div class="metric-label">Trips today</div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-top: 1rem;">
                    <div class="metric-value">0</div>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 2rem; height: 2rem; color: #cbd5e1;"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" /></svg>
                </div>
                <div class="metric-note">logged in last 24 hours</div>
            </article>
            <article class="metric-card">
                <div class="metric-label">Under maintenance</div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-top: 1rem;">
                    <div class="metric-value">1</div>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 2rem; height: 2rem; color: #cbd5e1;"><path d="M4 19h16" /><path d="M7 15v4" /><path d="M12 11v8" /><path d="M17 7v12" /></svg>
                </div>
                <div class="metric-note">1 overdue alert</div>
            </article>
        </div>

        <div class="charts-grid">
            <section class="content-card chart-panel">
                <div class="alert-header">
                    <div>
                        <div class="alert-label">Trips per vehicle</div>
                        <h2 class="alert-headline">Distance and frequency by plate</h2>
                    </div>
                </div>
                @if ($typeGroups->isEmpty())
                    <div class="alert-card">No request activity yet.</div>
                @else
                    <div class="chart-bar-row">
                        @foreach ($typeGroups as $type => $group)
                            @php $ratio = ($group->count() / $maxTypeCount) * 100; @endphp
                            <div>
                                <div class="progress-meta">
                                    <span>{{ $type }}</span>
                                    <span>{{ $group->count() }}</span>
                                </div>
                                <div class="progress-track">
                                    <div class="progress-fill" style="width: {{ $ratio }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <aside class="content-card alert-panel">
                <div class="alert-header" style="margin-bottom: 1.5rem;">
                    <div>
                        <div class="alert-label">ALERTS</div>
                        <h2 class="alert-headline">Alerts</h2>
                    </div>
                </div>

                <div class="alert-card">
                    <div class="alert-row">
                        <div style="font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase; color: #94a3b8; margin-bottom: 0.5rem;">LICENSE EXPIRING</div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <p class="alert-title">Sam Driver</p>
                            <p class="alert-date">2026-05-25</p>
                        </div>
                    </div>
                </div>

                <div class="alert-card">
                    <div class="alert-row">
                        <div style="font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase; color: #94a3b8; margin-bottom: 0.5rem; display: flex; gap: 0.5rem;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 1rem; height: 1rem;">⚠</svg>
                            MAINTENANCE DUE
                        </div>
                        <div style="display: grid; gap: 0.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <p class="alert-title">FL-3315</p>
                                <p class="alert-title">Tire Rotation</p>
                            </div>
                            <p style="color: #b45309; font-weight: 700; font-size: 0.9rem;">Due on 2026-05-03</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
