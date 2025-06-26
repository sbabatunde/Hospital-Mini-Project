<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorsAppraisal extends Model
{
    protected $fillable = [
        'doctor_id',
        'admin_id',
        'period',
        'professionalism',
        'punctuality',
        'patient_feedback',
        'case_handling',
        'appraisal_notes',
        'attachments'
    ];

    protected $casts = [
        'attachments' => 'array',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
