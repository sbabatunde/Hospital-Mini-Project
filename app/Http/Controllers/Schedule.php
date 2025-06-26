<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Schedule extends Controller
{
    public function store(Request $req)
    {
        $req->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'location' => 'nullable|string'
        ]);

        return Schedule::create([
            'doctor_id' => auth()->id(),
            'date' => $req->date,
            'start_time' => $req->start_time,
            'end_time' => $req->end_time,
            'location' => $req->location,
        ]);
    }

    public function viewDoctorSchedule($doctor_id)
    {
        return Schedule::where('doctor_id', $doctor_id)
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->get();
    }

    public function viewMySchedule()
    {
        return Schedule::where('doctor_id', auth()->id())
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->get();
    }
}
