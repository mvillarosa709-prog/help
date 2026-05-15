<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['vehicle', 'driver', 'destination', 'purpose', 'departure', 'return', 'odometer_start', 'odometer_end', 'distance'])]
class TripLog extends Model
{
    use HasFactory;

    protected $casts = [
        'departure' => 'datetime',
        'return' => 'datetime',
        'odometer_start' => 'integer',
        'odometer_end' => 'integer',
        'distance' => 'integer',
    ];
}