<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role == 'admin') {
            $doctors = Doctor::all();
            return view('admin.dashboard', compact('doctors'));
        } else if (auth()->user()->role == 'doctor') {
            $doctor = Auth::user()->doctor;
            if ($doctor) {
                $appointments = $doctor->appointments()->with('user')->get();
                return view('doctor.dashboard', compact('appointments'));
            } else {
                return view('doctor.dashboard')->withErrors('No doctor profile found. Please set up your profile.');
            }
        } else {
            $latestHealthRecord = Auth::user()->healthRecords()->latest()->first();
            $appointments = Auth::user()->appointments()->with('doctor')->get();

            if ($latestHealthRecord) {
                $latestHealthRecord->lastTestedDate = Carbon::parse($latestHealthRecord->lastTestedDate);
            }

            return view('dashboard', [
                'latestHealthRecord' => $latestHealthRecord,
                'appointments' => $appointments,
            ]);
        }
    }
}