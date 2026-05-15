@extends('layouts.app')

@section('title', 'Vehicles')

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
                <h1 style="margin: 0 0 0.5rem 0; font-size: 1.75rem; color: #0f172a;">Vehicles</h1>
                <p style="margin: 0; color: #64748b; font-size: 0.95rem;">Manage your fleet vehicles, photos, status and assignments.</p>
            </div>
            <button onclick="openAddVehicleModal()" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.8rem 1.25rem; background: #1d4ed8; color: #ffffff; border-radius: 0.85rem; font-weight: 600; font-size: 0.95rem; border: none; cursor: pointer;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 1.25rem; height: 1.25rem;"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Add vehicle
            </button>
        </div>

        <div class="vehicles-controls">
            <div class="search-bar" style="flex: 1;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 1.25rem; height: 1.25rem; color: #94a3b8;">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" placeholder="Search plate, make, model" class="search-input">
            </div>
            
            <select class="filter-select">
                <option>All types</option>
                <option>Sedan</option>
                <option>Truck</option>
                <option>Van</option>
                <option>SUV</option>
            </select>
            
            <select class="filter-select">
                <option>All statuses</option>
                <option>Available</option>
                <option>In use</option>
                <option>Maintenance</option>
                <option>Inactive</option>
            </select>
        </div>

        @if ($vehicles->isEmpty())
            <div class="empty-state">
                <div style="text-align: center;">
                    <h2 style="margin: 0 0 0.5rem 0; font-size: 1.25rem; font-weight: 700; color: #0f172a;">No vehicles yet</h2>
                    <p style="margin: 0; color: #64748b; font-size: 0.95rem;">Add your first vehicle to get started.</p>
                </div>
            </div>
        @else
            <div class="vehicles-grid">
                @foreach ($vehicles as $vehicle)
                    <div 
                        class="vehicle-card"
                        data-vehicle-id="{{ $vehicle->id }}"
                        data-plate="{{ $vehicle->plate_number }}"
                        data-make="{{ $vehicle->make }}"
                        data-model="{{ $vehicle->model }}"
                        data-year="{{ $vehicle->year }}"
                        data-color="{{ $vehicle->color ?? '' }}"
                        data-type="{{ $vehicle->type ?? '' }}"
                        data-fuel="{{ $vehicle->fuel_type ?? '' }}"
                        data-status="{{ $vehicle->status }}"
                        data-odometer="{{ $vehicle->odometer }}"
                        data-interval="{{ $vehicle->maintenance_interval }}"
                        data-driver="{{ $vehicle->assigned_driver ?? '' }}"
                    >
                        <div class="vehicle-card-header">
                            <div>
                                <h3 class="vehicle-plate">{{ $vehicle->plate_number }}</h3>
                                <p class="vehicle-model">{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}</p>
                            </div>
                            <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $vehicle->status)) }}">{{ $vehicle->status }}</span>
                        </div>

                        <div class="vehicle-card-details">
                            <div class="detail-row">
                                <span class="detail-label">Type</span>
                                <span class="detail-value">{{ $vehicle->type ?? '–' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Fuel</span>
                                <span class="detail-value">{{ $vehicle->fuel_type ?? '–' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Odometer</span>
                                <span class="detail-value">{{ number_format($vehicle->odometer) }} km</span>
                            </div>
                            @if ($vehicle->assigned_driver)
                                <div class="detail-row">
                                    <span class="detail-label">Driver</span>
                                    <span class="detail-value">{{ $vehicle->assigned_driver }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="vehicle-card-actions">
                            <button type="button" class="action-button edit-button" onclick="openEditVehicleModal({{ $vehicle->id }})">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9" /><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z" /></svg>
                                Edit
                            </button>
                            <form method="POST" action="{{ route('vehicles.destroy', $vehicle) }}" onsubmit="return confirm('Delete this vehicle?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-button delete-button">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6" /><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" /><path d="M10 11v6" /><path d="M14 11v6" /><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" /></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Add Vehicle Modal -->
<div id="addVehicleModal" class="modal">
    <div class="modal-overlay" onclick="closeAddVehicleModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add vehicle</h2>
            <button onclick="closeAddVehicleModal()" class="modal-close-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form method="POST" action="{{ route('vehicles.store') }}" class="modal-body">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Plate number</label>
                    <input name="plate_number" type="text" placeholder="e.g., FL-2201" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Year</label>
                    <input name="year" type="number" placeholder="2026" class="form-input" value="2026" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Make</label>
                    <input name="make" type="text" placeholder="e.g., Toyota" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Model</label>
                    <input name="model" type="text" placeholder="e.g., Camry" class="form-input" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Color</label>
                    <input name="color" type="text" placeholder="e.g., White" class="form-input">
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form-input" required>
                        <option>Sedan</option>
                        <option>SUV</option>
                        <option>Truck</option>
                        <option>Van</option>
                        <option>Bus</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Fuel type</label>
                    <select name="fuel_type" class="form-input" required>
                        <option>Petrol</option>
                        <option>Diesel</option>
                        <option>Electric</option>
                        <option>Hybrid</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-input" required>
                        <option>Available</option>
                        <option>In use</option>
                        <option>Maintenance</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Odometer (km)</label>
                    <input name="odometer" type="number" placeholder="0" class="form-input" value="0" required>
                </div>
                <div class="form-group">
                    <label>Maint. interval (km)</label>
                    <input name="maintenance_interval" type="number" placeholder="5000" class="form-input" value="5000" required>
                </div>
            </div>

            <div class="form-group">
                <label>Assigned driver (optional)</label>
                <input name="assigned_driver" type="text" placeholder="e.g., John Doe" class="form-input">
            </div>

            <div class="modal-footer">
                <button type="button" onclick="closeAddVehicleModal()" class="cancel-button">Cancel</button>
                <button type="submit" class="create-button">Create vehicle</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Vehicle Modal -->
<div id="editVehicleModal" class="modal">
    <div class="modal-overlay" onclick="closeEditVehicleModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit vehicle</h2>
            <button onclick="closeEditVehicleModal()" class="modal-close-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form id="editVehicleForm" method="POST" action="" class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group">
                    <label>Plate number</label>
                    <input id="editPlate" name="plate_number" type="text" placeholder="e.g., FL-2201" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Year</label>
                    <input id="editYear" name="year" type="number" placeholder="2026" class="form-input" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Make</label>
                    <input id="editMake" name="make" type="text" placeholder="e.g., Toyota" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Model</label>
                    <input id="editModel" name="model" type="text" placeholder="e.g., Camry" class="form-input" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Color</label>
                    <input id="editColor" name="color" type="text" placeholder="e.g., White" class="form-input">
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <select id="editType" name="type" class="form-input" required>
                        <option>Sedan</option>
                        <option>SUV</option>
                        <option>Truck</option>
                        <option>Van</option>
                        <option>Bus</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Fuel type</label>
                    <select id="editFuel" name="fuel_type" class="form-input" required>
                        <option>Petrol</option>
                        <option>Diesel</option>
                        <option>Electric</option>
                        <option>Hybrid</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select id="editStatus" name="status" class="form-input" required>
                        <option>Available</option>
                        <option>In use</option>
                        <option>Maintenance</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Odometer (km)</label>
                    <input id="editOdometer" name="odometer" type="number" placeholder="0" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Maint. interval (km)</label>
                    <input id="editInterval" name="maintenance_interval" type="number" placeholder="5000" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label>Assigned driver (optional)</label>
                <input id="editDriver" name="assigned_driver" type="text" placeholder="e.g., John Doe" class="form-input">
            </div>

            <div class="modal-footer">
                <button type="button" onclick="closeEditVehicleModal()" class="cancel-button">Cancel</button>
                <button type="submit" class="create-button">Save changes</button>
            </div>
        </form>
    </div>
</div>

<style>
    .vehicles-controls {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        align-items: center;
    }
    
    .search-bar {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 0.85rem;
        padding: 0.9rem 1rem;
    }
    
    .search-input {
        flex: 1;
        border: none;
        outline: none;
        font-size: 0.95rem;
        color: #0f172a;
        background: transparent;
    }
    
    .search-input::placeholder {
        color: #94a3b8;
    }
    
    .filter-select {
        padding: 0.9rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.85rem;
        background: #ffffff;
        color: #0f172a;
        font-size: 0.95rem;
        cursor: pointer;
        transition: border-color 0.2s ease;
    }
    
    .filter-select:hover {
        border-color: #cbd5e1;
    }

    .vehicles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .vehicle-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .vehicle-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .vehicle-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
    }

    .vehicle-plate {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
    }

    .vehicle-model {
        margin: 0.25rem 0 0 0;
        font-size: 0.9rem;
        color: #64748b;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.4rem 0.7rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-available {
        background: #d1fae5;
        color: #166534;
    }

    .status-in-use {
        background: #bfdbfe;
        color: #1e40af;
    }

    .status-maintenance {
        background: #fecaca;
        color: #991b1b;
    }

    .status-inactive {
        background: #e2e8f0;
        color: #475569;
    }
.vehicle-card-details {
        display: grid;
        gap: 0.75rem;
        padding: 1rem 0;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .detail-label {
        font-size: 0.85rem;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .detail-value {
        font-size: 0.9rem;
        color: #0f172a;
        font-weight: 500;
    }

    .vehicle-card-actions {
        display: flex;
        gap: 0.75rem;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        flex: 1;
        padding: 0.65rem 1rem;
        border: 1px solid #cbd5e1;
        border-radius: 0.6rem;
        background: #ffffff;
        color: #0f172a;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: background 0.2s ease, border-color 0.2s ease;
    }

    .action-button:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }

    .action-button svg {
        width: 1rem;
        height: 1rem;
    }

    .delete-button {
        border-color: #fecaca;
        color: #b91c1c;
    }

    .delete-button:hover {
        background: #fee2e2;
    }
    
    .empty-state {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 400px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 1.5rem;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        cursor: pointer;
    }

    .modal-content {
        position: relative;
        background: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        width: 90%;
        max-width: 600px;
        margin: auto;
        max-height: 90vh;
        overflow-y: auto;
        z-index: 1001;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
    }

    .modal-close-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        color: #94a3b8;
        transition: color 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-close-btn:hover {
        color: #0f172a;
    }

    .modal-close-btn svg {
        width: 1.5rem;
        height: 1.5rem;
    }

    .modal-body {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: #0f172a;
        font-size: 0.95rem;
    }

    .form-input {
        padding: 0.8rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.6rem;
        font-size: 0.95rem;
        color: #0f172a;
        background: #ffffff;
        transition: border-color 0.2s ease;
        font-family: inherit;
    }