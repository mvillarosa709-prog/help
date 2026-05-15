<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripLog extends Model
{
    use HasFactory;

    protected $table = 'trip_logs';

    protected $fillable = [
        'vehicle',
        'driver',
        'start_date',
        'end_date',
        'notes',
    ];
}
