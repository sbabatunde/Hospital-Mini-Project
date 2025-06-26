<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $fillable = [
        'client_id',
        'doctor_id',
        'scheduled_at',
        'status',
        'reason',
        'notes',
        'approved_at',
        'completed_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'approved_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /** 
     * The client who requested the appointment 
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /** 
     * The doctor assigned to the appointment 
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
