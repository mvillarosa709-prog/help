@extends('layouts.app')

@section('title', 'Maintenance')

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

    <div class="page-main">
        <div class="page-header">
            <div>
                <h1 class="page-title">Maintenance</h1>
                <p class="page-subtitle">Service records, costs and reminders for upcoming tasks.</p>
            </div>
            <button onclick="openMaintenanceModal()" class="btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Add record
            </button>
        </div>

        @if($maintenance->isEmpty())
            <div class="empty-state-card">
                <h2>No maintenance records</h2>
                <p>Add your first record to get started.</p>
            </div>
        @else
            <div class="data-table-card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Cost</th>
                            <th>Next Due</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($maintenance as $record)
                            <tr>
                                <td class="cell-bold">{{ $record->vehicle->vehicle_number ?? '-' }}</td>
                                <td>{{ $record->type }}</td>
                                <td>{{ $record->date->format('Y-m-d') }}</td>
                                <td class="cell-bold">${{ number_format($record->cost, 2) }}</td>
                                <td>
                                    <div class="cell-with-badge">
                                        {{ $record->next_due ? $record->next_due->format('Y-m-d') : '—' }}
                                        @if($record->isOverdue())
                                            <span class="badge-overdue">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:11px;height:11px"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                                Overdue
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="cell-remarks">{{ $record->remarks ?? '—' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button onclick="editMaintenance({{ $record->id }})" class="action-btn action-btn--edit" title="Edit">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" /><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
                                        </button>
                                        <form method="POST" action="{{ route('maintenance.destroy', $record->id) }}" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn action-btn--delete" title="Delete">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6" /><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Add/Edit Maintenance Modal -->
<div id="maintenanceModal" class="modal">
    <div class="modal-overlay" onclick="closeMaintenanceModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Add maintenance</h2>
            <button onclick="closeMaintenanceModal()" class="modal-close-btn" aria-label="Close modal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form id="maintenanceForm" method="POST" action="{{ route('maintenance.store') }}" class="modal-body">
            @csrf
            <input type="hidden" id="maintenanceId" name="maintenance_id">
            <input type="hidden" id="methodInput" name="_method" value="POST">

            <div class="form-group">
                <label>Vehicle</label>
                <select name="vehicle_id" class="form-input" required>
                    <option value="">Select vehicle</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form-input" required>
                        <option value="">Select type</option>
                        <option value="Oil Change">Oil Change</option>
                        <option value="Tire Rotation">Tire Rotation</option>
                        <option value="Brake Service">Brake Service</option>
                        <option value="Inspection">Inspection</option>
                        <option value="Repair">Repair</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" class="form-input" value="{{ now()->format('Y-m-d') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Cost (USD)</label>
                    <input type="number" name="cost" class="form-input" step="0.01" min="0" value="0" required>
                </div>
                <div class="form-group">
                    <label>Next due date</label>
                    <input type="date" name="next_due" class="form-input">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group" style="grid-column: span 2;">
                    <label>Next due km</label>
                    <input type="number" name="next_due_km" class="form-input" min="0" placeholder="">
                </div>
            </div>

            <div class="form-group">
                <label>Remarks</label>
                <textarea name="remarks" class="form-input" rows="4" placeholder="Add optional notes"></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" onclick="closeMaintenanceModal()" class="cancel-button">Cancel</button>
                <button type="submit" class="create-button" id="submitBtn">Add record</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Page Layout */
    .page-main { min-width: 0; }
    .page-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; gap: 1rem; }
    .page-title { margin: 0 0 0.4rem 0; font-size: 1.75rem; font-weight: 700; color: #0f172a; }
    .page-subtitle { margin: 0; color: #64748b; font-size: 0.95rem; }
    .btn-primary { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.7rem 1.15rem; background: #1d4ed8; color: #ffffff; border-radius: 0.75rem; font-weight: 600; font-size: 0.9rem; border: none; cursor: pointer; white-space: nowrap; transition: background .2s ease; }
    .btn-primary:hover { background: #1e40af; }

    /* Data Table */
    .data-table-card { background: #ffffff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; }
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { border-bottom: 1px solid #e2e8f0; }
    .data-table th { padding: 0.85rem 1rem; text-align: left; font-weight: 600; font-size: 0.75rem; color: #ef4444; text-transform: uppercase; letter-spacing: 0.06em; background: #ffffff; }
    .data-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: background .15s ease; }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #f8fafc; }
    .data-table td { padding: 0.85rem 1rem; color: #475569; font-size: 0.9rem; }
    .cell-bold { font-weight: 600; color: #0f172a; }
    .cell-remarks { max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .cell-with-badge { display: flex; align-items: center; gap: 0.5rem; }
    .badge-overdue { display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.2rem 0.6rem; background: #fef2f2; color: #dc2626; border-radius: 0.4rem; font-size: 0.7rem; font-weight: 600; white-space: nowrap; }

    /* Action Buttons */
    .action-buttons { display: flex; gap: 0.4rem; }
    .action-btn { display: inline-flex; align-items: center; justify-content: center; width: 2rem; height: 2rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; background: #ffffff; cursor: pointer; transition: all .2s ease; }
    .action-btn svg { width: 14px; height: 14px; }
    .action-btn--edit { color: #64748b; }
    .action-btn--edit:hover { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
    .action-btn--delete { color: #ef4444; }
    .action-btn--delete:hover { background: #fef2f2; color: #dc2626; border-color: #fca5a5; }

    /* Empty State */
    .empty-state-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 3rem 2rem; text-align: center; }
    .empty-state-card h2 { margin: 0 0 0.5rem; font-size: 1.15rem; font-weight: 700; color: #0f172a; }
    .empty-state-card p { margin: 0; color: #64748b; font-size: 0.95rem; }

    /* Modal */
    .modal { display: none; position: fixed; inset: 0; z-index: 1000; align-items: center; justify-content: center; padding: 1.5rem; }
    .modal.active { display: flex; }
    .modal-overlay { position: absolute; inset: 0; background: rgba(15, 23, 42, 0.45); backdrop-filter: blur(2px); cursor: pointer; }
    .modal-content { position: relative; width: min(760px, 100%); background: #ffffff; border-radius: 1.5rem; box-shadow: 0 36px 80px rgba(15, 23, 42, 0.18); padding: 2rem; z-index: 1; }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .modal-header h2 { margin: 0; font-size: 1.5rem; color: #111827; }
    .modal-close-btn { display: inline-flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; border: 1px solid #e2e8f0; border-radius: 0.75rem; background: #ffffff; color: #475569; cursor: pointer; }
    .modal-close-btn svg { width: 18px; height: 18px; }
    .modal-body { display: grid; gap: 1rem; }
    .form-row { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; }
    .form-group { display: grid; gap: 0.45rem; }
    .form-group label { font-size: 0.85rem; color: #475569; font-weight: 600; }
    .form-input { width: 100%; padding: 0.8rem 0.9rem; border: 1px solid #e2e8f0; border-radius: 0.75rem; background: #ffffff; color: #0f172a; font-size: 0.9rem; font-family: inherit; }
    .form-input:focus { outline: none; border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
    .modal-footer { display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1rem; }
    .cancel-button, .create-button { min-width: 100px; padding: 0.75rem 1rem; border-radius: 0.75rem; border: none; font-weight: 600; font-size: 0.9rem; cursor: pointer; }
    .cancel-button { background: #f1f5f9; color: #475569; }
    .cancel-button:hover { background: #e2e8f0; }
    .create-button { background: #1d4ed8; color: #ffffff; }
    .create-button:hover { background: #1e40af; }

    @media (max-width: 820px) {
        .form-row { grid-template-columns: 1fr; }
    }
</style>

<script>
    function openMaintenanceModal() {
        document.getElementById('maintenanceModal').classList.add('active');
        document.getElementById('modalTitle').textContent = 'Add maintenance';
        document.getElementById('submitBtn').textContent = 'Add record';
        document.getElementById('maintenanceForm').action = '{{ route("maintenance.store") }}';
        document.getElementById('maintenanceForm').reset();
        document.getElementById('methodInput').value = 'POST';
        document.getElementById('maintenanceId').value = '';
        document.querySelector('input[name="date"]').value = new Date().toISOString().split('T')[0];
    }

    function closeMaintenanceModal() {
        document.getElementById('maintenanceModal').classList.remove('active');
    }

    function editMaintenance(id) {
        fetch(`/maintenance/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalTitle').textContent = 'Edit maintenance';
                document.getElementById('submitBtn').textContent = 'Update record';
                document.getElementById('maintenanceForm').action = `/maintenance/${id}`;
                document.getElementById('methodInput').value = 'PATCH';
                document.getElementById('maintenanceId').value = id;

                document.querySelector('select[name="vehicle_id"]').value = data.vehicle_id;
                document.querySelector('select[name="type"]').value = data.type;
                document.querySelector('input[name="date"]').value = data.date;
                document.querySelector('input[name="cost"]').value = data.cost;
                document.querySelector('input[name="next_due"]').value = data.next_due || '';
                document.querySelector('input[name="next_due_km"]').value = data.next_due_km || '';
                document.querySelector('textarea[name="remarks"]').value = data.remarks || '';

                document.getElementById('maintenanceModal').classList.add('active');
            });
    }
</script>
@endsection
