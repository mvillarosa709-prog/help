@extends('layouts.app')

@section('title', 'Trip Logs')

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
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem;">
            <div>
                <h1 style="margin: 0 0 0.5rem 0; font-size: 1.75rem; color: #0f172a;">Trip Logs</h1>
                <p style="margin: 0; color: #64748b; font-size: 0.95rem;">Record and review trips with auto-calculated distance.</p>
            </div>
            <button onclick="openLogTripModal()" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.8rem 1.25rem; background: #1d4ed8; color: #ffffff; border-radius: 0.85rem; font-weight: 600; font-size: 0.95rem; border: none; cursor: pointer;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 1.25rem; height: 1.25rem;"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Log trip
            </button>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem; margin-bottom: 1.75rem;">
            <select class="filter-select" style="padding: 0.85rem 1rem; border: 1px solid #e2e8f0; border-radius: 1rem; background: #ffffff; color: #0f172a;">
                <option>All vehicles</option>
                <option>FL-3315</option>
                <option>FL-2201</option>
            </select>
            <select class="filter-select" style="padding: 0.85rem 1rem; border: 1px solid #e2e8f0; border-radius: 1rem; background: #ffffff; color: #0f172a;">
                <option>All drivers</option>
                <option>Sam Driver</option>
                <option>Maria Lopez</option>
            </select>
            <input type="date" class="filter-select" style="padding: 0.85rem 1rem; border: 1px solid #e2e8f0; border-radius: 1rem; background: #ffffff; color: #0f172a;" />
            <input type="date" class="filter-select" style="padding: 0.85rem 1rem; border: 1px solid #e2e8f0; border-radius: 1rem; background: #ffffff; color: #0f172a;" />
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; min-width: 900px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1.25rem; overflow: hidden;">
                <thead style="background: #f8fafc; color: #64748b; text-align: left; font-size: 0.85rem; letter-spacing: 0.08em; text-transform: uppercase;">
                    <tr>
                        <th style="padding: 1rem 1.25rem;">Vehicle</th>
                        <th style="padding: 1rem 1.25rem;">Driver</th>
                        <th style="padding: 1rem 1.25rem;">Destination</th>
                        <th style="padding: 1rem 1.25rem;">Purpose</th>
                        <th style="padding: 1rem 1.25rem;">Departure</th>
                        <th style="padding: 1rem 1.25rem;">Return</th>
                        <th style="padding: 1rem 1.25rem;">Distance</th>
                        <th style="padding: 1rem 1.25rem;">Actions</th>
                    </tr>
                </thead>
                <tbody style="color: #475569; font-size: 0.95rem;">
                    <tr style="border-top: 1px solid #e2e8f0;">
                        <td style="padding: 1rem 1.25rem;">FL-3315</td>
                        <td style="padding: 1rem 1.25rem;">Sam Driver</td>
                        <td style="padding: 1rem 1.25rem;">Downtown Warehouse</td>
                        <td style="padding: 1rem 1.25rem;">Cargo delivery</td>
                        <td style="padding: 1rem 1.25rem;">5/5/2026, 4:00:27 PM</td>
                        <td style="padding: 1rem 1.25rem;">5/5/2026, 7:30:27 PM</td>
                        <td style="padding: 1rem 1.25rem; font-weight: 700;">120 km</td>
                        <td style="padding: 1rem 1.25rem; display: flex; gap: 0.5rem;">
                            <button style="border:none; background:#eef2ff; color:#1d4ed8; padding:0.55rem 0.75rem; border-radius:0.85rem; cursor:pointer;">Edit</button>
                            <button style="border:none; background:#fee2e2; color:#b91c1c; padding:0.55rem 0.75rem; border-radius:0.85rem; cursor:pointer;">Delete</button>
                        </td>
                    </tr>
                    <tr style="border-top: 1px solid #e2e8f0;">
                        <td style="padding: 1rem 1.25rem;">FL-2201</td>
                        <td style="padding: 1rem 1.25rem;">Maria Lopez</td>
                        <td style="padding: 1rem 1.25rem;">Client Visit - North Plaza</td>
                        <td style="padding: 1rem 1.25rem;">Sales meeting</td>
                        <td style="padding: 1rem 1.25rem;">5/4/2026, 5:00:27 PM</td>
                        <td style="padding: 1rem 1.25rem;">5/4/2026, 9:00:27 PM</td>
                        <td style="padding: 1rem 1.25rem; font-weight: 700;">80 km</td>
                        <td style="padding: 1rem 1.25rem; display: flex; gap: 0.5rem;">
                            <button style="border:none; background:#eef2ff; color:#1d4ed8; padding:0.55rem 0.75rem; border-radius:0.85rem; cursor:pointer;">Edit</button>
                            <button style="border:none; background:#fee2e2; color:#b91c1c; padding:0.55rem 0.75rem; border-radius:0.85rem; cursor:pointer;">Delete</button>
                        </td>
                    </tr>
                    <tr style="border-top: 1px solid #e2e8f0;">
                        <td style="padding: 1rem 1.25rem;">FL-3315</td>
                        <td style="padding: 1rem 1.25rem;">Sam Driver</td>
                        <td style="padding: 1rem 1.25rem;">Airport Pickup</td>
                        <td style="padding: 1rem 1.25rem;">Executive transport</td>
                        <td style="padding: 1rem 1.25rem;">5/3/2026, 10:00:27 AM</td>
                        <td style="padding: 1rem 1.25rem;">5/4/2026, 1:00:27 AM</td>
                        <td style="padding: 1rem 1.25rem; font-weight: 700;">70 km</td>
                        <td style="padding: 1rem 1.25rem; display: flex; gap: 0.5rem;">
                            <button style="border:none; background:#eef2ff; color:#1d4ed8; padding:0.55rem 0.75rem; border-radius:0.85rem; cursor:pointer;">Edit</button>
                            <button style="border:none; background:#fee2e2; color:#b91c1c; padding:0.55rem 0.75rem; border-radius:0.85rem; cursor:pointer;">Delete</button>
                        </td>
                    </tr>
                    <tr style="border-top: 1px solid #e2e8f0;">
                        <td style="padding: 1rem 1.25rem;">FL-2201</td>
                        <td style="padding: 1rem 1.25rem;">Maria Lopez</td>
                        <td style="padding: 1rem 1.25rem;">Office HQ</td>
                        <td style="padding: 1rem 1.25rem;">Daily commute</td>
                        <td style="padding: 1rem 1.25rem;">5/2/2026, 4:30:27 PM</td>
                        <td style="padding: 1rem 1.25rem;">5/3/2026, 2:00:27 AM</td>
                        <td style="padding: 1rem 1.25rem; font-weight: 700;">50 km</td>
                        <td style="padding: 1rem 1.25rem; display: flex; gap: 0.5rem;">
                            <button style="border:none; background:#eef2ff; color:#1d4ed8; padding:0.55rem 0.75rem; border-radius:0.85rem; cursor:pointer;">Edit</button>
                            <button style="border:none; background:#fee2e2; color:#b91c1c; padding:0.55rem 0.75rem; border-radius:0.85rem; cursor:pointer;">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Log Trip Modal -->
<div id="logTripModal" class="modal">
    <div class="modal-overlay" onclick="closeLogTripModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Log trip</h2>
            <button onclick="closeLogTripModal()" class="modal-close-btn" aria-label="Close modal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label>Vehicle</label>
                    <select class="form-input">
                        <option>Select vehicle</option>
                        <option>FL-3315</option>
                        <option>FL-2201</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Driver</label>
                    <select class="form-input">
                        <option>Select driver</option>
                        <option>Sam Driver</option>
                        <option>Maria Lopez</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Destination</label>
                    <input type="text" placeholder="Enter destination" class="form-input">
                </div>
                <div class="form-group">
                    <label>Purpose</label>
                    <input type="text" placeholder="Enter purpose" class="form-input">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Departure</label>
                    <input type="datetime-local" class="form-input" value="{{ now()->format('Y-m-d\TH:i') }}">
                </div>
                <div class="form-group">
                    <label>Return</label>
                    <input type="datetime-local" class="form-input">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Odometer start</label>
                    <input type="number" class="form-input" placeholder="0">
                </div>
                <div class="form-group">
                    <label>Odometer end</label>
                    <input type="number" class="form-input" placeholder="0">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" onclick="closeLogTripModal()" class="cancel-button">Cancel</button>
                <button type="submit" class="create-button">Log trip</button>
            </div>
        </form>
    </div>
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        z-index: 1000;
    }

    .modal.active {
        display: flex;
    }

    .modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(2px);
        cursor: pointer;
    }

    .modal-content {
        position: relative;
        width: min(860px, 100%);
        background: #ffffff;
        border-radius: 1.5rem;
        box-shadow: 0 36px 80px rgba(15, 23, 42, 0.18);
        padding: 2rem;
        z-index: 1;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 1.5rem;
        color: #111827;
    }

    .modal-close-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.75rem;
        height: 2.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.85rem;
        background: #ffffff;
        color: #475569;
        cursor: pointer;
    }

    .modal-body {
        display: grid;
        gap: 1rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
    }

    .form-group {
        display: grid;
        gap: 0.55rem;
    }

    .form-group label {
        font-size: 0.9rem;
        color: #475569;
        font-weight: 600;
    }

    .form-input {
        width: 100%;
        padding: 0.95rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        background: #ffffff;
        color: #0f172a;
        font-size: 0.95rem;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .cancel-button,
    .create-button {
        min-width: 110px;
        padding: 0.85rem 1rem;
        border-radius: 0.9rem;
        border: none;
        font-weight: 600;
        cursor: pointer;
    }

    .cancel-button {
        background: #f8fafc;
        color: #475569;
    }

    .create-button {
        background: #1d4ed8;
        color: #ffffff;
    }

    @media (max-width: 820px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    function openLogTripModal() {
        document.getElementById('logTripModal').classList.add('active');
    }

    function closeLogTripModal() {
        document.getElementById('logTripModal').classList.remove('active');
    }
</script>
@endsection
