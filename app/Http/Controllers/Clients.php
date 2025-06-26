<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use App\Models\Appointments;
use Illuminate\Http\Request;
use App\Models\MedicalHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Clients extends Controller
{
    public function store(Request $req)
    {
        $req->validate([
            'doctor_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        return Rating::create([
            'client_id' => auth()->id(),
            'doctor_id' => $req->doctor_id,
            'rating' => $req->rating,
            'comment' => $req->comment,
        ]);
    }

    public function doctorRatings($doctor_id)
    {
        return Rating::where('doctor_id', $doctor_id)->get();
    }

    public function clientHistory()
    {
        $histories = MedicalHistory::where('client_id', Auth::id())
            ->latest()
            ->paginate(5);
        return view('client.medical-history.index', compact('histories'));
    }

    public function showMedicalHistory($id)
    {
        $history = MedicalHistory::with('doctor')
            ->where('client_id', auth()->id())
            ->findOrFail($id);

        return view('client.medical-history.show', compact('history'));
    }


    public function downloadAttachment($id, $index)
    {
        $history = MedicalHistory::findOrFail($id);
        $attachments = json_decode($history->attachments, true);

        if (!isset($attachments[$index])) {
            return response()->json(['error' => 'Attachment not found'], 404);
        }

        return Storage::disk('public')->download($attachments[$index]);
    }

    public function index()
    {
        $user = auth()->user();

        return view('client.dashboard', [
            'appointments' => $user->requestedAppointments()->where('status', '<>', 'completed')->latest()->take(3)->get(),
            'histories' => $user->clientmedicalHistories()->latest()->take(3)->get(),
        ]);
    }


    public function mySchedule()
    {
        $appointments = Appointments::with('doctor')
            ->where('client_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('client.schedule.index', compact('appointments'));
    }

    public function showSchedule($id)
    {
        if (auth()->user()->role === 'admin') {
            // dd('You are not authorized to view this appointment.');
            $appointment = Appointments::with('doctor')
                ->findOrFail($id);
        } else {
            $appointment = Appointments::with('doctor')
                ->where('client_id', Auth::id())
                ->findOrFail($id);
        }



        return view('client.schedule.show', compact('appointment'));
    }

    // public function rating()
    public function rating()
    {
        $clientId = auth()->id();

        // Get all doctors the client has appointments with
        $doctorIds = Appointments::where('client_id', $clientId)
            ->whereNotNull('doctor_id')
            ->pluck('doctor_id')
            ->unique();

        $doctors = User::whereIn('id', $doctorIds)->get();

        $ratings = Rating::where('client_id', $clientId)
            ->whereIn('doctor_id', $doctorIds)
            ->get();

        return view('client.ratings.index', compact('doctors', 'ratings'));
    }


    public function createRating(User $doctor)
    {
        return view('client.ratings.create', compact('doctor'));
    }

    public function storeRating(Request $request, User $doctor)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Rating::updateOrCreate(
            [
                'client_id' => auth()->id(),
                'doctor_id' => $doctor->id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return redirect()->route('client.ratings.index')->with('success', 'Thank you for rating this doctor!');
    }

    public function editRating($doctorId)
    {
        $clientId = auth()->id();

        // Ensure the client has rated this doctor
        $rating = Rating::where('client_id', $clientId)
            ->where('doctor_id', $doctorId)
            ->firstOrFail();

        $doctor = User::where('id', $doctorId)
            ->where('role', 'doctor')
            ->firstOrFail();

        return view('client.ratings.edit', compact('rating', 'doctor'));
    }

    public function updateRating(Request $request, $doctorId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $clientId = auth()->id();

        $rating = Rating::where('client_id', $clientId)
            ->where('doctor_id', $doctorId)
            ->firstOrFail();

        $rating->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('client.ratings.index')->with('success', 'Rating updated successfully.');
    }
}
