<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use App\Models\Appointments;
use Illuminate\Http\Request;
use App\Models\DoctorsAppraisal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class Admin extends Controller
{
    public function appraisalForm($doctor_id)
    {
        $doctor = User::findOrFail($doctor_id);
        return view('admin.doctors.appraisal.create', compact('doctor'));
    }

    public function createAppraisal(Request $request, $doctor_id)
    {
        $request->validate([
            'period' => 'required|string|max:50',
            'professionalism' => 'nullable|integer|min:1|max:10',
            'punctuality' => 'nullable|integer|min:1|max:10',
            'patient_feedback' => 'nullable|integer|min:1|max:10',
            'case_handling' => 'nullable|integer|min:1|max:10',
            'appraisal_notes' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240', // up to 10MB each
        ]);

        $attachments = [];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachments[] = $file->store('appraisals', 'public');
            }
        }

        $appraisal = DoctorsAppraisal::create([
            'doctor_id' => $doctor_id,
            'admin_id' => Auth::id(),
            'period' => $request->period,
            'professionalism' => $request->professionalism,
            'punctuality' => $request->punctuality,
            'patient_feedback' => $request->patient_feedback,
            'case_handling' => $request->case_handling,
            'appraisal_notes' => $request->appraisal_notes,
            'attachments' => $attachments ? json_encode($attachments) : null,
        ]);

        return back()->with('success', 'Doctor appraisal successfully saved.');
    }

    public function index()
    {
        $doctors = User::where('role', 'doctor')->with('ratingsReceived')->get();
        $clients = User::where('role', 'client')->get();
        $appointments = Appointments::with('client', 'doctor')->latest()->take(5)->get();
        $totalRatings = Rating::count();

        return view('admin.dashboard', compact('doctors', 'clients', 'appointments', 'totalRatings'));
    }

    public function recentSchedules()
    {
        $appointments = Appointments::with('doctor', 'client')
            ->latest()
            ->take(5)
            ->paginate(10);

        return view('admin.doctors.recent-schedules', compact('appointments'));
    }

    public function listAppraisals()
    {
        $appraisals = DoctorsAppraisal::with(['doctor', 'admin'])
            ->latest()
            ->get();

        return view('admin.doctors.appraisal.index', compact('appraisals'));
    }

    public function viewDoctorAppraisals($doctor_id)
    {
        $appraisals = DoctorsAppraisal::where('doctor_id', $doctor_id)
            ->with('admin')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.doctors.appraisal.index', compact('appraisals'));
    }

    public function showDoctorAppraisals($appraisalId)
    {
        $appraisal = DoctorsAppraisal::find($appraisalId);

        return view('admin.doctors.appraisal.show', compact('appraisal'));
    }

    public function downloadAttachment($id, $index)
    {
        $appraisal = DoctorsAppraisal::findOrFail($id);
        $attachments = json_decode($appraisal->attachments, true);

        if (!isset($attachments[$index])) {
            return response()->json(['error' => 'Attachment not found'], 404);
        }

        return Storage::disk('public')->download($attachments[$index]);
    }

    public function allMails()
    {
        $notifications = DatabaseNotification::latest()->paginate(10);

        return view('admin.mails.index', compact('notifications'));
    }

    public function showMail($id)
    {
        $notification = DatabaseNotification::findOrFail($id);

        // Optionally mark as read
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return view('admin.mails.show', compact('notification'));
    }

    public function doctors()
    {
        $doctors = User::where('role', 'doctor')->withCount('ratingsReceived')->with('ratingsReceived')->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    public function showDoctor(User $doctor)
    {
        abort_if($doctor->role !== 'doctor', 403);
        return view('admin.doctors.show', compact('doctor'));
    }

    public function schedules(User $doctor)
    {
        abort_if($doctor->role !== 'doctor', 403);

        $appointments = Appointments::where('doctor_id', $doctor->id)
            ->with('client')
            ->latest()
            ->paginate(10);

        return view('admin.doctors.schedules', compact('doctor', 'appointments'));
    }

    public function clients()
    {
        $clients = User::where('role', 'client')
            ->latest()
            ->paginate(10);

        return view('admin.clients.index', compact('clients'));
    }
}
