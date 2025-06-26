<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function homepage()
    {
        $featuredDoctors = User::where('role', 'doctor')->latest()->take(8)->get();
        return view('home', compact('featuredDoctors'));
    }

    public function doctors()
    {
        $doctors = User::where('role', 'doctor')->paginate(9);
        return view('home.doctors', compact('doctors'));
    }

    public function showDoctor($id)
    {
        $doctor = User::where('role', 'doctor')->findOrFail($id);
        return view('home.show-doctor', compact('doctor'));
    }
}
