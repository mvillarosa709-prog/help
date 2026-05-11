@extends('layouts.app')

@section('title', 'Reports & Analytics')

@section('content')
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
                <a href="{{ route('reports') }}" class="sidebar-link {{ $current === 'reports' ? 'active' : '' }}">
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
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem;">
            <div>
                <h1 style="margin: 0 0 0.5rem 0; font-size: 2rem; color: #0f172a;">Reports & Analytics</h1>
                <p style="margin: 0; color: #64748b; font-size: 0.95rem;">Fleet utilization, maintenance spend and fuel consumption.</p>
            </div>
            <button style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.8rem 1.25rem; background: #ffffff; color: #0f172a; border: 1px solid #e2e8f0; border-radius: 0.85rem; font-weight: 600; font-size: 0.95rem; cursor: pointer;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 1.1rem; height: 1.1rem;"><path d="M12 5v14" /><path d="M5 12h14" /></svg>
                CSV
            </button>
        </div>

        <div class="report-card">
            <h2>Fleet utilization</h2>
            <div class="report-chart">
                <div class="report-bar" style="height: 60%;"><span>FL-2201</span></div>
                <div class="report-bar report-bar-alt" style="height: 90%;"><span>FL-3315</span></div>
                <div class="report-bar" style="height: 0;"><span>FL-4408</span></div>
                <div class="report-bar report-bar-alt" style="height: 0;"><span>FL-5512</span></div>
            </div>
            <div class="report-legend">
                <div><span class="legend-color legend-distance"></span>Distance (km)</div>
                <div><span class="legend-color legend-trips"></span>Trips</div>
            </div>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Plate</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Trips</th>
                        <th>Distance (km)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>FL-2201</td><td>Toyota</td><td>Camry</td><td>2</td><td>130</td></tr>
                    <tr><td>FL-3315</td><td>Ford</td><td>Transit</td><td>2</td><td>190</td></tr>
                    <tr><td>FL-4408</td><td>Honda</td><td>CR-V</td><td>0</td><td>0</td></tr>
                    <tr><td>FL-5512</td><td>Isuzu</td><td>D-Max</td><td>0</td><td>0</td></tr>
                </tbody>
            </table>
        </div>

        <div class="report-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <h2>Maintenance cost summary</h2>
                </div>
                <button style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.7rem 1rem; background: #ffffff; color: #0f172a; border: 1px solid #e2e8f0; border-radius: 0.85rem; font-weight: 600; font-size: 0.95rem; cursor: pointer;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 1rem; height: 1rem;"><path d="M12 5v14" /><path d="M5 12h14" /></svg>
                    CSV
                </button>
            </div>
            <div class="report-chart report-chart-green">
                <div class="report-bar" style="height: 20%;"><span>FL-2201</span></div>
                <div class="report-bar" style="height: 15%;"><span>FL-3315</span></div>
                <div class="report-bar" style="height: 25%;"><span>FL-4408</span></div>
                <div class="report-bar" style="height: 90%;"><span>FL-5512</span></div>
            </div>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Plate</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Services</th>
                        <th>Total Cost ($)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>FL-2201</td><td>Toyota</td><td>Camry</td><td>1</td><td>65</td></tr>
                    <tr><td>FL-3315</td><td>Ford</td><td>Transit</td><td>1</td><td>40</td></tr>
                    <tr><td>FL-4408</td><td>Honda</td><td>CR-V</td><td>1</td><td>90</td></tr>
                    <tr><td>FL-5512</td><td>Isuzu</td><td>D-Max</td><td>1</td><td>480</td></tr>
                </tbody>
            </table>
        </div>

        <div class="report-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <h2>Fuel consumption estimates</h2>
                </div>
                <button style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.7rem 1rem; background: #ffffff; color: #0f172a; border: 1px solid #e2e8f0; border-radius: 0.85rem; font-weight: 600; font-size: 0.95rem; cursor: pointer;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 1rem; height: 1rem;"><path d="M12 5v14" /><path d="M5 12h14" /></svg>
                    CSV
                </button>
            </div>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Plate</th>
                        <th>Fuel</th>
                        <th>Distance (km)</th>
                        <th>Est. Liters</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>FL-2201</td><td>Petrol</td><td>130</td><td>10.83</td></tr>
                    <tr><td>FL-3315</td><td>Diesel</td><td>190</td><td>12.67</td></tr>
                    <tr><td>FL-4408</td><td>Hybrid</td><td>0</td><td>0</td></tr>
                    <tr><td>FL-5512</td><td>Diesel</td><td>0</td><td>0</td></tr>
                </tbody>
            </table>
            <p style="margin-top: 0.75rem; color: #64748b; font-size: 0.9rem;">Estimates use an average kmpl per fuel type (petrol 12, diesel 15, hybrid 20, cng 18).</p>
        </div>
    </div>
</div>

<style>
    .report-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.5rem;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.06);
        padding: 1.75rem;
        margin-bottom: 1.75rem;
    }

    .report-chart {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
        align-items: end;
        min-height: 220px;
        padding: 1rem 0;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 1rem;
    }

    .report-chart-green {
        background: #f8fafc;
    }

    .report-bar {
        position: relative;
        background: #0f172a;
        border-radius: 1.25rem;
        min-height: 3rem;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        color: #ffffff;
        font-size: 0.75rem;
        padding: 0.5rem 0.35rem 0.35rem;
    }

    .report-bar-alt {
        background: #2563eb;
    }

    .report-legend {
        display: flex;
        gap: 1.5rem;
        font-size: 0.9rem;
        color: #475569;
        margin-bottom: 1rem;
    }

    .legend-color {
        display: inline-block;
        width: 1rem;
        height: 1rem;
        border-radius: 0.4rem;
        margin-right: 0.5rem;
        vertical-align: middle;
    }

    .legend-distance {
        background: #0f172a;
    }

    .legend-trips {
        background: #2563eb;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
        color: #475569;
    }

    .report-table th,
    .report-table td {
        padding: 1rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }

    .report-table th {
        color: #64748b;
        font-size: 0.82rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .report-table tr:last-child td {
        border-bottom: none;
    }

    @media (max-width: 980px) {
        .report-chart {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 720px) {
        .app-shell {
            grid-template-columns: 1fr;
        }
        .report-chart {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection
