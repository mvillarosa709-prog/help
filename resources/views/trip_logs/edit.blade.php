@extends('layouts.app')

@section('title', 'Edit Trip Log')

@section('content')

<div style="max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 12px;">

    {{-- BACK BUTTON --}}
    <a href="{{ route('trip-logs.index') }}"
       style="display:inline-block; margin-bottom:15px; padding:8px 12px; background:#64748b; color:#fff; border-radius:8px;">
        ← Back
    </a>

    <h2>Edit Trip Log</h2>

    <form method="POST" action="{{ route('trip-logs.update', $tripLog->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="vehicle" value="{{ $tripLog->vehicle }}" class="input">
        <input type="text" name="driver" value="{{ $tripLog->driver }}" class="input">
        <input type="text" name="destination" value="{{ $tripLog->destination }}" class="input">
        <input type="text" name="purpose" value="{{ $tripLog->purpose }}" class="input">

        <input type="datetime-local" name="departure"
            value="{{ \Carbon\Carbon::parse($tripLog->departure)->format('Y-m-d\TH:i') }}" class="input">

        <input type="datetime-local" name="return"
            value="{{ $tripLog->return ? \Carbon\Carbon::parse($tripLog->return)->format('Y-m-d\TH:i') : '' }}" class="input">

        <input type="number" name="odometer_start" value="{{ $tripLog->odometer_start }}" class="input">
        <input type="number" name="odometer_end" value="{{ $tripLog->odometer_end }}" class="input">

        <button type="submit" style="margin-top:10px; padding:10px; background:#1d4ed8; color:white; border:none; border-radius:8px;">
            Update
        </button>
    </form>

</div>

<style>
.input{
    width:100%;
    padding:10px;
    margin-bottom:10px;
    border:1px solid #ccc;
    border-radius:8px;
}
</style>

@endsection