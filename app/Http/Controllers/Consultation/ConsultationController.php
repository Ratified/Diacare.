<?php

namespace App\Http\Controllers\Consultation;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultationController extends Controller
{
    public function index()
    {
        // Fetch all doctors with their availabilities
        $doctors = Doctor::with('availabilities')->get();
        return view('consultation.index', compact('doctors'));
    }
}
