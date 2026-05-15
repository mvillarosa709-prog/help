<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';

    protected $fillable = [
        'vehicle_id',
        'type',
        'date',
        'cost',
        'next_due',
        'next_due_km',
        'remarks',
    ];

    protected $casts = [
        'date' => 'date',
        'next_due' => 'date',
        'cost' => 'decimal:2',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function isOverdue()
    {
        return $this->next_due && $this->next_due->isPast();
    }
}
