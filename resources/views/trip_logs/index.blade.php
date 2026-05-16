@extends('layouts.app')

@section('title', 'Trip Logs')

@section('content')
<div class="app-shell">

    {{-- HEADER --}}
    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:2rem;">
        <div>
            <h1 style="margin:0 0 0.5rem 0;">Trip Logs</h1>
            <p style="margin:0; color:#64748b;">Record and review trips with distance tracking.</p>
        </div>

        <button onclick="openLogTripModal()"
            style="padding:0.8rem 1.2rem; background:#1d4ed8; color:white; border:none; border-radius:10px; cursor:pointer;">
            Log Trip
        </button>
    </div>

    {{-- TABLE (SCROLL FIXED) --}}
    <div style="max-height:65vh; overflow:auto; border:1px solid #e2e8f0; border-radius:10px;">
        <table style="width:100%; border-collapse:collapse; background:#fff; min-width:900px;">
            <thead>
                <tr style="background:#f1f5f9;">
                    <th>Vehicle</th>
                    <th>Driver</th>
                    <th>Destination</th>
                    <th>Purpose</th>
                    <th>Departure</th>
                    <th>Return</th>
                    <th>Distance</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tripLogs as $trip)
                <tr style="border-top:1px solid #e2e8f0;">

                    <td>{{ $trip->vehicle }}</td>
                    <td>{{ $trip->driver }}</td>
                    <td>{{ $trip->destination }}</td>
                    <td>{{ $trip->purpose }}</td>
                    <td>{{ $trip->departure }}</td>
                    <td>{{ $trip->return }}</td>
                    <td><b>{{ $trip->distance }} km</b></td>

                    <td style="display:flex; gap:8px; align-items:center;">

                        {{-- EDIT --}}
                        <a href="{{ route('trip-logs.edit', $trip->id) }}"
                           style="padding:6px 10px; background:#e0e7ff; color:#1d4ed8; border-radius:6px;">
                            Edit
                        </a>

                        {{-- DELETE --}}
                       <form action="{{ route('trip-logs.destroy', $trip->id) }}"
      method="POST"
      onsubmit="return confirm('Are you sure you want to delete this trip log?')">
    @csrf
    @method('DELETE')

    <button type="submit"
        style="padding:6px 10px; background:#fee2e2; color:#b91c1c; border:none; border-radius:6px; cursor:pointer;">
        Delete
    </button>
</form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ================= MODAL ================= --}}
{{-- ================= MODAL ================= --}}
<div id="logTripModal" class="modal">

    {{-- overlay (click = close) --}}
    <div class="modal-overlay" onclick="closeLogTripModal()"></div>

    <div class="modal-content">

        {{-- HEADER with EXIT BUTTON --}}
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h2 style="margin:0;">Log Trip</h2>

            {{-- EXIT BUTTON (X) --}}
            <button type="button"
                onclick="closeLogTripModal()"
                style="background:#fee2e2; color:#b91c1c; border:none; width:35px; height:35px; border-radius:8px; cursor:pointer; font-size:18px;">
                ✕
            </button>
        </div>

        <form method="POST" action="{{ route('trip-logs.store') }}">
            @csrf

            <label>Vehicle</label>
            <select name="vehicle" class="form-input">
                <option value="">Select</option>
                <option>FL-3315</option>
                <option>FL-2201</option>
            </select>

            <label>Driver</label>
            <select name="driver" class="form-input">
                <option value="">Select</option>
                <option>Sam Driver</option>
                <option>Maria Lopez</option>
            </select>

            <label>Destination</label>
            <input type="text" name="destination" class="form-input">

            <label>Purpose</label>
            <input type="text" name="purpose" class="form-input">

            <label>Departure</label>
            <input type="datetime-local" name="departure" class="form-input">

            <label>Return</label>
            <input type="datetime-local" name="return" class="form-input">

            <label>Odometer Start</label>
            <input type="number" name="odometer_start" class="form-input">

            <label>Odometer End</label>
            <input type="number" name="odometer_end" class="form-input">

            <button type="submit"
                style="margin-top:10px; padding:10px; background:#1d4ed8; color:white; border:none; border-radius:8px;">
                Save
            </button>
        </form>

    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
function openLogTripModal() {
    document.getElementById('logTripModal').classList.add('active');
}

function closeLogTripModal() {
    document.getElementById('logTripModal').classList.remove('active');
}

/* BONUS: ESC key close */
document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") {
        closeLogTripModal();
    }
});
</script>
{{-- ================= STYLE ================= --}}
<style>
.modal {
    display:none;
    position:fixed;
    inset:0;
    justify-content:center;
    align-items:center;
    background:rgba(0,0,0,0.4);
}

.modal.active {
    display:flex;
}

.modal-content {
    background:white;
    padding:20px;
    border-radius:12px;
    width:500px;
    max-height:80vh;
    overflow-y:auto;
}

.form-input {
    width:100%;
    padding:10px;
    margin-bottom:10px;
    border:1px solid #e2e8f0;
    border-radius:8px;
}
</style>

@endsection