<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function create($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        return view('appointments.create', compact('doctor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $doctor = Doctor::findOrFail($request->doctor_id);
        $available = $doctor->availabilities->filter(function($availability) use ($request) {
            $startTime = strtotime($availability->start_time);
            $endTime = strtotime($availability->end_time);
            $appointmentTime = strtotime($request->time);

            return $availability->day == date('l', strtotime($request->date)) && $appointmentTime >= $startTime && $appointmentTime <= $endTime;
        })->count() > 0;

        if (!$available) {
            return redirect()->back()->withErrors(['time' => 'The doctor is not available at this time. Please check their availability.']);
        }

        Appointment::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('message', 'Appointment booked successfully');
    }
}