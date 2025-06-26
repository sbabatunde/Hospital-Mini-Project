<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Appointments as Appoint;
use Flasher\Toastr\Laravel\Facade\Toastr;
use App\Notifications\AppointmentRequestedNotification;
use App\Notifications\AppointmentUpdatedNotification;

class Appointment extends Controller
{
    public function requestAppointment(Request $req)
    {
        $req->validate([
            'doctor_id' => 'required|exists:users,id',
            'scheduled_at' => 'required|date|after:now',
            'reason' => 'nullable|string|max:1000',
        ]);

        $appointment =  Appoint::create([
            'client_id' => auth()->id(),
            'doctor_id' => $req->doctor_id,
            'scheduled_at' => $req->scheduled_at,
            'reason' => $req->reason,
            'status' => 'pending',
        ]);
        // Notify the doctor
        $doctor = User::findOrFail($req->doctor_id);
        $doctor->notify(new AppointmentRequestedNotification($appointment));

        toastify()->success('Appointment requested successfully!');
        return redirect()->route('client.dashboard')->with('success', 'Schedule request submitted!');
    }

    // List all appointments for the logged-in doctor
    public function index()
    {
        $appointments = Appoint::where('doctor_id', auth()->id())
            ->with('client')
            ->orderBy('scheduled_at', 'desc')->paginate(5);;

        return view('doctor.schedule.view', compact('appointments'));
    }

    public function show($id)
    {
        $appointment = Appoint::with(['client', 'doctor'])
            ->where('doctor_id', auth()->id())
            ->findOrFail($id);

        return view('doctor.schedule.show', compact('appointment'));
    }

    public function rescheduleForm($id)
    {
        $appointment = Appoint::where('doctor_id', auth()->id())->findOrFail($id);
        return view('doctor.schedule.reschedule', compact('appointment'));
    }

    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'scheduled_at' => 'required|date|after:now',
            'note' => 'nullable|string|max:1000',
        ]);

        $appointment = Appoint::where('doctor_id', auth()->id())->findOrFail($id);

        $appointment->update([
            'scheduled_at' => $request->scheduled_at,
            'notes' => $request->note,
            'status' => 'rescheduled',
        ]);

        // Notify the client
        $appointment->client->notify(new AppointmentUpdatedNotification($appointment, 'rescheduled'));

        return redirect()->route('doctor.schedules.index')->with('success', 'Appointment rescheduled.');
    }


    // Approve an appointment
    public function approve($id)
    {
        $appointment = Appoint::where('doctor_id', auth()->id())->findOrFail($id);

        $appointment->update([
            'status' => 'approved',
            'approved_at' => now()
        ]);

        // Notify client
        $appointment->client->notify(new AppointmentUpdatedNotification($appointment, 'approved'));

        return redirect()->back()->with('success', 'Appointment approved.');
    }

    // Cancel an appointment
    public function cancel($id)
    {
        $appointment = Appoint::where('doctor_id', auth()->id())->findOrFail($id);

        $appointment->update([
            'status' => 'cancelled'
        ]);

        // Notify client
        $appointment->client->notify(new AppointmentUpdatedNotification($appointment, 'cancelled'));

        return redirect()->back()->with('success', 'Appointment cancelled.');
    }

    // Mark appointment as completed
    public function complete($id)
    {
        $appointment = Appoint::where('doctor_id', auth()->id())->findOrFail($id);

        $appointment->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        // Notify client
        $appointment->client->notify(new AppointmentUpdatedNotification($appointment, 'completed'));

        return redirect()->back()->with('success', 'Appointment marked as completed.');
    }
}
