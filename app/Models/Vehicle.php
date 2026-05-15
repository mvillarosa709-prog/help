<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_number',
        'make',
        'model',
        'year',
        'color',
        'type',
        'fuel_type',
        'status',
        'odometer',
        'maintenance_interval',
        'assigned_driver'
    ];

    protected $casts = [
        'year' => 'integer',
        'odometer' => 'integer',
        'maintenance_interval' => 'integer',
    ];

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function getVehicleNumberAttribute()
    {
        return $this->plate_number;
    }
}