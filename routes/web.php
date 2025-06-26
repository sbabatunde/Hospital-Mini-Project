<?php

use App\Models\User;
use App\Models\Appointments;
use App\Http\Controllers\Home;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Clients;
use App\Http\Controllers\Doctors;
use App\Http\Controllers\Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Notfications;
use App\Http\Controllers\ProfileController;


Route::get('/', [Home::class, 'homepage'])->name('home');
Route::get('/doctors/all', [Home::class, 'doctors'])->name('home.doctors');
Route::get('/doctor/show/{id}', [Home::class, 'showDoctor'])->name('home.doctor.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/show/{id?}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/notifications', [Notfications::class, 'index'])->name('notifications.index');
    Route::get('/mails/{id}', [Notfications::class, 'show'])->name('mails.show');
    Route::get('/create', [Notfications::class, 'create'])->name('mails.create');
    Route::post('/send', [Notfications::class, 'send'])->name('mails.send');
    Route::post('/notifications/read', [Notfications::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::post('/mails/{id}/mark-as-read', [Notfications::class, 'markAsRead'])->name('notifications.markAsRead');
    // Public routes
    // Route::get('/', fn() => view('welcome'));
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [Admin::class, 'index'])->name('dashboard');
        Route::post('/appraisals/{doctor_id}', [Admin::class, 'createAppraisal'])->name('doctor.appraise');
        Route::get('/appraisals/{doctor_id}', [Admin::class, 'appraisalForm'])->name('doctor.appraisal.form');
        Route::get('/appraisals', [Admin::class, 'listAppraisals'])->name('doctors.appraisals.list');
        Route::get('/appraisals/doctor/{appraisalId}', [Admin::class, 'showDoctorAppraisals'])->name('doctor.appraisals.show');
        Route::get('/appraisals/doctor/view/{doctor_id}', [Admin::class, 'viewDoctorAppraisals'])->name('doctor.appraisals.view');
        Route::get('/appraisals/{id}/download/{index}', [Admin::class, 'downloadAttachment']);
        Route::get('/mails/index', [Admin::class, 'allMails'])->name('mails.index');
        Route::get('/mail/show/{id}', [Admin::class, 'showMail'])->name('mails.show');
        Route::get('/doctors', [Admin::class, 'doctors'])->name('doctors');
        Route::get('/doctors/{doctor}', [Admin::class, 'showDoctor'])->name('doctors.show');
        Route::get('/doctors/schedules/recent', [Admin::class, 'recentSchedules'])->name('schedules.recent');
        Route::get('/doctors/{doctor}/schedules', [Admin::class, 'schedules'])->name('doctor.schedules');
        Route::get('/schedule/{id}', [Clients::class, 'showSchedule'])->name('schedule.show');
        Route::get('/clients', [Admin::class, 'clients'])->name('clients');
        Route::get('/appointments', [Admin::class, 'appointments'])->name('appointments');
        Route::get('/ratings', [Admin::class, 'ratings'])->name('ratings');
        Route::get('/reports', [Admin::class, 'doctorReport'])->name('reports.index');
        Route::get('/reports/{id}', [Admin::class, 'showReport'])->name('reports.show');
        Route::get('/clients', [Admin::class, 'clients'])->name('clients.index');
    });

    Route::middleware(['role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/schedule/request', function () {
            // Fetch all doctors (assuming 'role' column distinguishes them)
            $doctor = auth()->user();

            // Pass the doctors variable to the Blade view
            return view('doctor.dashboard', [
                'newAppointmentsCount' => $doctor->doctorAppointments()->where('status', 'pending')->count(),
                'approvedAppointmentsCount' => $doctor->doctorAppointments()->where('status', 'approved')->count(),
                'rescheduledAppointmentsCount' => $doctor->doctorAppointments()->where('status', 'rescheduled')->count(),
                'completedAppointmentsCount' => $doctor->doctorAppointments()->where('status', 'completed')->count(),
                'canceledAppointmentsCount' => $doctor->doctorAppointments()->where('status', 'canceled')->count(),
                'upcomingAppointments' => $doctor->doctorAppointments()
                    ->where('scheduled_at', '>=', now())
                    ->orderBy('scheduled_at', 'asc')
                    ->take(5)
                    ->get()
            ]);
        })->name('dashboard');

        Route::get('/medical-report/{id}', function ($id) {
            // Fetch all doctors (assuming 'role' column distinguishes them)
            $appointment = Appointments::where('id', $id)->with('client')->first();
            // Pass the doctors variable to the Blade view
            return view('doctor.medical-report.form', compact('appointment'));
        })->name('medical-report');

        //Medical History
        Route::get('reports', [Doctors::class, 'doctorReports'])->name('reports.index');
        Route::get('reports/{id}', [Doctors::class, 'showReport'])->name('reports.show');
        Route::post('/doctor/medical-history/store', [Doctors::class, 'store'])
            ->name('history.store');

        Route::get('/schedule/{id}/reschedule', [Appointment::class, 'rescheduleForm'])
            ->name('reschedule.form');

        Route::post('/schedule/{id}/reschedule', [Appointment::class, 'reschedule'])
            ->name('schedule.reschedule');

        Route::get('/schedule/show/{id}', [Appointment::class, 'show'])->name('schedule.show');
        Route::post('schedule/{id}/view', [Appointment::class, 'approve'])->name('appointments.approve');
        Route::post('/schedule/{id}/approve', [Appointment::class, 'approve'])->name('appointments.approve');
        Route::post('/schedule/{id}/cancel', [Appointment::class, 'cancel'])->name('appointments.cancel');
        Route::post('/schedule/{id}/complete', [Appointment::class, 'complete'])->name('appointments.complete');

        Route::get('/schedules', [Appointment::class, 'index'])->name('schedules.index');
        // Route::get('/reports', [Admin::class, 'doctorReport'])->name('reports.index');
        Route::get('/schedules/{id}/download/{index}', [Admin::class, 'downloadAttachment'])->name('appointments.download');
        Route::get('/history', [Admin::class, 'doctorHistory'])->name('history');
    });

    Route::middleware(['role:client'])->prefix('client')->name('client.')->group(function () {
        // Route::get('/client/home', fn() => view('client.home'))->name('client.home');
        Route::get('/schedules/request', function () {
            // Fetch all doctors (assuming 'role' column distinguishes them)
            $doctors = User::where('role', 'doctor')->get();

            // Pass the doctors variable to the Blade view
            return view('client.schedule.request', [
                'doctors' => $doctors,
            ]);
        })->name('appointments.request');
        Route::post('/rating', [Clients::class, 'store'])->name('ratings.store');
        Route::get('/doctor/{doctor_id}/ratings', [Clients::class, 'doctorRatings'])->name('ratings.doctor');
        Route::get('/history', [Clients::class, 'clientHistory'])->name('history');
        Route::get('/history/show/{id}', [Clients::class, 'showMedicalHistory'])->name('history.show');
        Route::get('/history/{id}/download/{index}', [Clients::class, 'downloadAttachment'])->name('history.download');
        Route::get('/dashboard', [Clients::class, 'index'])->name('dashboard');
        Route::post('/schedules/request', [Appointment::class, 'requestAppointment'])->name('appointments.request');
        Route::get('/schedules', [Clients::class, 'mySchedule'])->name('schedule.index');
        Route::get('/schedule/{id}', [Clients::class, 'showSchedule'])->name('schedule.show');
        Route::get('/ratings', [Clients::class, 'rating'])->name('ratings.index');
        Route::get('/ratings/{doctor}/rate', [Clients::class, 'createRating'])->name('ratings.create');
        Route::post('/ratings/{doctor}', [Clients::class, 'storeRating'])->name('ratings.store');
        Route::get('/edit/{doctor}', [Clients::class, 'editRating'])->name('ratings.edit');
        Route::put('/update/{doctor}', [Clients::class, 'updateRating'])->name('ratings.update');
    });
});

require __DIR__ . '/auth.php';
