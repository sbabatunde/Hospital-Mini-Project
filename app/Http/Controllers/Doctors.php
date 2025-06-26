<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointments;
use App\Notifications\MedicalReportNotification;

class Doctors extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'diagnosis' => 'nullable|string|max:255',
            'medications' => 'nullable|string',
            'next_visit' => 'nullable|date|after_or_equal:today',
            'attachments.*' => 'nullable|file|max:10240', // max 10MB per file
        ]);

        $attachments = [];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachments[] = $file->store('medical_attachments', 'public');
            }
        }

        $history = MedicalHistory::create([
            'client_id' => $request->client_id,
            'doctor_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'diagnosis' => $request->diagnosis,
            'medications' => $request->medications,
            'next_visit' => $request->next_visit,
            'attachments' => $attachments ? json_encode($attachments) : null,
        ]);

        $appointment = Appointments::where('doctor_id', auth()->id())->findOrFail($request->appointment_id);

        $appointment->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        // 🔔 Notify client
        $history->client->notify(new MedicalReportNotification($history));

        return redirect()->route('doctor.dashboard')->with('success', 'Medical report saved and client notified.');
    }

    public function clientHistory()
    {
        return MedicalHistory::where('client_id', Auth::id())
            ->latest()
            ->get();
    }

    public function doctorView($client_id)
    {
        return MedicalHistory::where('client_id', $client_id)
            ->latest()
            ->get();
    }

    public function doctorReports()
    {
        $reports = MedicalHistory::with('client')
            ->where('doctor_id', auth()->id())
            ->latest()
            ->paginate(5);

        return view('doctor.medical-report.index', compact('reports'));
    }

    public function showReport($id)
    {
        $report = MedicalHistory::with(['client', 'doctor'])->findOrFail($id);

        // Optional: restrict if not the owner
        if ($report->doctor_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('doctor.medical-report.show', compact('report'));
    }
}
