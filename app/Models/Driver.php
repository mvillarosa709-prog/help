<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\AsDateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'license_number', 'license_expiry', 'contact', 'email', 'assigned_vehicle', 'status'])]
class Driver extends Model
{
    use HasFactory;

    protected $casts = [
        'license_expiry' => 'date',
    ];
}
