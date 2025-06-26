<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'client_id',
        'doctor_id',
        'rating',
        'comment',
    ];
}
