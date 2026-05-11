<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripLogController extends Controller
{
    public function index()
    {
        return view('trip_logs.index');
    }
}
