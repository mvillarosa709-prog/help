@extends('layouts.app')

@section('title', 'Drivers')

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
                <h1 style="margin: 0 0 0.5rem 0; font-size: 1.75rem; color: #0f172a;">Drivers</h1>
                <p style="margin: 0; color: #64748b; font-size: 0.95rem;">Manage driver records, license validity and vehicle assignments.</p>
            </div>
            <button onclick="openAddDriverModal()" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.8rem 1.25rem; background: #1d4ed8; color: #ffffff; border-radius: 0.85rem; font-weight: 600; font-size: 0.95rem; border: none; cursor: pointer;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 1.25rem; height: 1.25rem;"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Add driver
            </button>
        </div>

        <div class="empty-state">
            <div style="text-align: center;">
                <h2 style="margin: 0 0 0.5rem 0; font-size: 1.25rem; font-weight: 700; color: #0f172a;">No drivers yet</h2>
                <p style="margin: 0; color: #64748b; font-size: 0.95rem;">Create your first driver record.</p>
            </div>
        </div>
    </div>
</div>

<!-- Add Driver Modal -->
<div id="addDriverModal" class="modal">
    <div class="modal-overlay" onclick="closeAddDriverModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add driver</h2>
            <button onclick="closeAddDriverModal()" class="modal-close-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label>Full name</label>
                    <input type="text" placeholder="e.g., John Doe" class="form-input">
                </div>
                <div class="form-group">
                    <label>License number</label>
                    <input type="text" placeholder="e.g., DL-2024-001" class="form-input">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>License expiry</label>
                    <input type="date" placeholder="mm/dd/yyyy" class="form-input">
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <input type="tel" placeholder="e.g., +1 (555) 123-4567" class="form-input">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Email (optional)</label>
                    <input type="email" placeholder="e.g., john@example.com" class="form-input">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-input">
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>On leave</option>
                        <option>Suspended</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Assigned vehicle</label>
                <select class="form-input">
                    <option>– Unassigned –</option>
                    <option>FL-2201 (Toyota Camry)</option>
                    <option>FL-3315 (Honda CR-V)</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" onclick="closeAddDriverModal()" class="cancel-button">Cancel</button>
                <button type="submit" class="create-button">Create driver</button>
            </div>
        </form>
    </div>
</div>

<style>
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
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
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

    .form-input:focus {
        outline: none;
        border-color: #1d4ed8;
        box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.1);
    }

    .form-input::placeholder {
        color: #94a3b8;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding: 2rem;
        border-top: 1px solid #e2e8f0;
    }

    .cancel-button {
        padding: 0.8rem 1.5rem;
        border: 1px solid #cbd5e1;
        border-radius: 0.6rem;
        background: #ffffff;
        color: #0f172a;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background .2s ease, border-color .2s ease;
    }

    .cancel-button:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }

    .create-button {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 0.6rem;
        background: #1d4ed8;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background .2s ease;
    }

    .create-button:hover {
        background: #1e40af;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .modal-content {
            width: 95%;
        }

        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 1.5rem;
        }
    }
</style>

<script>
    function openAddDriverModal() {
        document.getElementById('addDriverModal').classList.add('active');
    }

    function closeAddDriverModal() {
        document.getElementById('addDriverModal').classList.remove('active');
    }

    // Close modal when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('addDriverModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddDriverModal();
            }
        });
    });
</script>
@endsection
