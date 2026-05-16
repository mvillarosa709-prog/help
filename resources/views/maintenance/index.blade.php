@extends('layouts.app')

@section('title', 'Maintenance')

@section('content')

<div class="page-main">

    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h1 class="page-title">Maintenance</h1>
            <p class="page-subtitle">
                Service records and maintenance schedules.
            </p>
        </div>

        <button type="button"
            onclick="openMaintenanceModal()"
            class="btn-primary">
            + Add Record
        </button>

    </div>

    {{-- TABLE --}}
    <div class="table-wrapper">

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

                @forelse($maintenance as $record)
                <tr>
                    <td>{{ $record->vehicle->vehicle_number ?? '-' }}</td>
                    <td>{{ $record->type }}</td>
                    <td>{{ $record->date }}</td>
                    <td>₱{{ number_format($record->cost, 2) }}</td>
                    <td>{{ $record->next_due ?? '-' }}</td>
                    <td>{{ $record->remarks ?? '-' }}</td>

                    <td>
                        <button type="button"
                            onclick='openEditModal(@json($record))'>
                            Edit
                        </button>

                        <form method="POST"
                            action="{{ route('maintenance.destroy', $record->id) }}"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Delete this record?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;">
                        No maintenance records found.
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>
</div>

{{-- ================= ADD MODAL ================= --}}
<div id="maintenanceModal" class="modal">

    <div class="modal-overlay" onclick="closeMaintenanceModal()"></div>

    <div class="modal-content">

        <div class="modal-header">
            <h2>Add Maintenance Record</h2>

            <button type="button"
                onclick="closeMaintenanceModal()"
                class="close-btn">✕</button>
        </div>

        <form method="POST" action="{{ route('maintenance.store') }}">
            @csrf

            {{-- VEHICLE --}}
            <div class="form-group">
                <label>Vehicle</label>

                <select name="vehicle_id" class="form-input" required>
                    <option value="">Select vehicle</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">
                            {{ $vehicle->vehicle_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TYPE --}}
            <div class="form-group">
                <label>Type</label>

                <select name="type" class="form-input" required>
                    <option value="">Select type</option>
                    <option value="Oil Change">Oil Change</option>
                    <option value="Repair">Repair</option>
                    <option value="Inspection">Inspection</option>
                    <option value="Brake Service">Brake Service</option>
                </select>
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-input" required>
            </div>

            <div class="form-group">
                <label>Cost</label>
                <input type="number" name="cost" class="form-input" required>
            </div>

            <div class="form-group">
                <label>Next Due</label>
                <input type="date" name="next_due" class="form-input">
            </div>

            <div class="form-group">
                <label>Remarks</label>
                <textarea name="remarks" class="form-input"></textarea>
            </div>

            <div class="modal-footer">
                <button type="button"
                    onclick="closeMaintenanceModal()"
                    class="cancel-btn">
                    Cancel
                </button>

                <button type="submit"
                    class="save-btn">
                    Save Record
                </button>
            </div>

        </form>

    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
<div id="editModal" class="modal">

    <div class="modal-overlay" onclick="closeEditModal()"></div>

    <div class="modal-content">

        <div class="modal-header">
            <h2>Edit Maintenance Record</h2>

            <button type="button"
                onclick="closeEditModal()"
                class="close-btn">✕</button>
        </div>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Vehicle</label>

                <select name="vehicle_id" id="edit_vehicle" class="form-input" required>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">
                            {{ $vehicle->vehicle_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Type</label>

                <select name="type" id="edit_type" class="form-input" required>
                    <option value="Oil Change">Oil Change</option>
                    <option value="Repair">Repair</option>
                    <option value="Inspection">Inspection</option>
                    <option value="Brake Service">Brake Service</option>
                </select>
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" id="edit_date" class="form-input">
            </div>

            <div class="form-group">
                <label>Cost</label>
                <input type="number" name="cost" id="edit_cost" class="form-input">
            </div>

            <div class="form-group">
                <label>Next Due</label>
                <input type="date" name="next_due" id="edit_next_due" class="form-input">
            </div>

            <div class="form-group">
                <label>Remarks</label>
                <textarea name="remarks" id="edit_remarks" class="form-input"></textarea>
            </div>

            <div class="modal-footer">
                <button type="button"
                    onclick="closeEditModal()"
                    class="cancel-btn">
                    Cancel
                </button>

                <button type="submit"
                    class="save-btn">
                    Update Record
                </button>
            </div>

        </form>

    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>

function openMaintenanceModal(){
    document.getElementById('maintenanceModal').classList.add('active');
}

function closeMaintenanceModal(){
    document.getElementById('maintenanceModal').classList.remove('active');
}

function openEditModal(data){

    document.getElementById('editModal').classList.add('active');

    document.getElementById('editForm').action = '/maintenance/' + data.id;

    document.getElementById('edit_vehicle').value = data.vehicle_id;
    document.getElementById('edit_type').value = data.type;
    document.getElementById('edit_date').value = data.date;
    document.getElementById('edit_cost').value = data.cost;
    document.getElementById('edit_next_due').value = data.next_due;
    document.getElementById('edit_remarks').value = data.remarks;
}

function closeEditModal(){
    document.getElementById('editModal').classList.remove('active');
}

</script>

{{-- ================= STYLE (UNCHANGED MO) ================= --}}
<style>

.page-main {
    width: 100%;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.page-title {
    margin: 0;
    font-size: 32px;
}

.page-subtitle {
    color: #64748b;
}

.btn-primary {
    background: #1d4ed8;
    color: white;
    border: none;
    padding: 12px 18px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
}

.table-wrapper {
    overflow-x: auto;
    background: white;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th,
.data-table td {
    padding: 15px;
    border-bottom: 1px solid #e2e8f0;
    text-align: left;
}

.data-table th {
    background: #f8fafc;
}

.modal {
    display: none;
    position: fixed;
    inset: 0;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.modal.active {
    display: flex;
}

.modal-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
}

.modal-content {
    position: relative;
    background: white;
    width: 900px;
    max-width: 95%;
    border-radius: 18px;
    padding: 30px;
    z-index: 2;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.close-btn {
    border: none;
    background: none;
    font-size: 24px;
    cursor: pointer;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 7px;
    font-weight: 600;
}

.form-input {
    width: 100%;
    padding: 12px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    font-size: 15px;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 25px;
}

.cancel-btn {
    padding: 12px 18px;
    border: none;
    border-radius: 10px;
    background: #e2e8f0;
    cursor: pointer;
}

.save-btn {
    padding: 12px 18px;
    border: none;
    border-radius: 10px;
    background: #1d4ed8;
    color: white;
    cursor: pointer;
}

</style>

@endsection