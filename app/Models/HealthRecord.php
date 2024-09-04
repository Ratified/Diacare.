<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight',
        'height',
        'systolic_pressure',
        'diastolic_pressure',
        'blood_sugar',
        'cholesterol',
        'temperature',
        'pulse',
        'lastTestedDate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}