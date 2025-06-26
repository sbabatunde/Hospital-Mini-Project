<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Appointments;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'specialization',
        'bio',
        'license_number',
        'photo',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function medicalHistories()
    {
        return $this->hasMany(MedicalHistory::class, 'doctor_id');
    }

    public function clientmedicalHistories()
    {
        return $this->hasMany(MedicalHistory::class, 'client_id');
    }


    // For clients
    public function requestedAppointments()
    {
        return $this->hasMany(Appointments::class, 'client_id');
    }

    // For doctors
    public function doctorAppointments()
    {
        return $this->hasMany(Appointments::class, 'doctor_id');
    }

    public function ratingsGiven()
    {
        return $this->hasMany(Rating::class, 'client_id');
    }

    public function ratingsReceived()
    {
        return $this->hasMany(Rating::class, 'doctor_id');
    }
    // Doctors Average Rating
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function appraisals()
    {
        return $this->hasMany(DoctorsAppraisal::class, 'doctor_id');
    }

    public function writtenAppraisals()
    {
        return $this->hasMany(DoctorsAppraisal::class, 'admin_id');
    }

    public function receivedAppraisals()
    {
        return $this->hasMany(DoctorsAppraisal::class, 'doctor_id');
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }

    public function receivedMails()
    {
        return $this->hasMany(DoctorsMail::class, 'receiver_id');
    }

    public function sentMails()
    {
        return $this->hasMany(DoctorsMail::class, 'sender_id');
    }


    // For clients (booked schedules)
    public function bookedSchedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'client_id');
    }

    // For clients (booked schedules)
    public function hasRole()
    {
        return $this->role === 'doctor' || $this->role === 'client' || $this->role === 'admin';
    }
}
