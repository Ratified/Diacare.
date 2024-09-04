<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'day', 'start_time', 'end_time'];

    protected $casts = [
        'start_time'=> 'datetime:H:i',
        'end_time'=> 'datetime:H:i',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
