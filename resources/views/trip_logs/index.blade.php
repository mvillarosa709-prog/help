@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header + Log Trip Button --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Trip Logs</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logTripModal">
            + Log trip
        </button>
    </div>

    {{-- Filters --}}
    <div class="card p-3 mb-3">
        <div class="row g-2">

            {{-- Vehicle Filter --}}
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">All vehicles</option>
                    @foreach($vehicles as $vehicle)
                        <option>{{ $vehicle->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Driver Filter --}}
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">All drivers</option>
                    @foreach($drivers as $driver)
                        <option>{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Date From --}}
            <div class="col-md-3">
                <input type="date" class="form-control">
            </div>

            {{-- Date To --}}
            <div class="col-md-3">
                <input type="date" class="form-control">
            </div>

        </div>
    </div>

    {{-- No Trips --}}
    @if($trips->count() == 0)
        <div class="text-center p-5 border rounded">
            <h5>No trips logged</h5>
            <p class="text-muted">Use "Log trip" to record a new journey.</p>
        </div>

    {{-- Trips Table --}}
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Driver</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trips as $trip)
                <tr>
                    <td>{{ $trip->vehicle }}</td>
                    <td>{{ $trip->driver }}</td>
                    <td>{{ $trip->start_date }}</td>
                    <td>{{ $trip->end_date }}</td>
                    <td>{{ $trip->notes }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

{{-- Log Trip Modal --}}
<div class="modal fade" id="logTripModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('trip-logs.store') }}" class="modal-content">
        @csrf

        <div class="modal-header">
            <h5 class="modal-title">Log Trip</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            {{-- Vehicle --}}
            <div class="mb-2">
                <label class="form-label">Vehicle</label>
                <select name="vehicle" class="form-select" required>
                    <option value="">Select vehicle</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->name }}">{{ $vehicle->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Driver --}}
            <div class="mb-2">
                <label class="form-label">Driver</label>
                <select name="driver" class="form-select" required>
                    <option value="">Select driver</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->name }}">{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Start Date --}}
            <div class="mb-2">
                <label class="form-label">Start date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            {{-- End Date --}}
            <div class="mb-2">
                <label class="form-label">End date</label>
                <input type="date" name="end_date" class="form-control">
            </div>

            {{-- Notes --}}
            <div class="mb-2">
                <label class="form-label">Notes</label>
                <textarea name="notes" class="form-control" rows="3"></textarea>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Trip</button>
        </div>

    </form>
  </div>
</div>

@endsection
