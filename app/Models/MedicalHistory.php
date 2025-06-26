<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    protected $fillable = [
        'client_id',
        'doctor_id',
        'title',
        'description',
        'diagnosis',
        'medications',
        'next_visit',
        'attachments'
    ];

    protected $casts = [
        'attachments' => 'array',
        'next_visit' => 'date'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
