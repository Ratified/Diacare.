<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'target_date',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'target_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
