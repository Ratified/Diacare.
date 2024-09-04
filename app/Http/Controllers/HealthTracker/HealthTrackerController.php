<?php

namespace App\Http\Controllers\HealthTracker;

use App\Models\HealthRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HealthTrackerController extends Controller
{
    public function index(){
        return view('health-tracker.index');
    }

    public function store(Request $request){
        $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'systolic_pressure' => 'required|numeric',
            'diastolic_pressure' => 'required|numeric',
            'blood_sugar' => 'required|numeric',
            'cholesterol' => 'required|numeric',
            'temperature' => 'required|numeric',
            'pulse' => 'required|numeric',
            'lastTestedDate' => 'required|date',
        ]);
    
        // Create a new health record instance
        $healthRecord = new HealthRecord([
            'weight' => $request->weight,
            'height' => $request->height,
            'systolic_pressure' => $request->systolic_pressure,
            'diastolic_pressure' => $request->diastolic_pressure,
            'blood_sugar' => $request->blood_sugar,
            'cholesterol' => $request->cholesterol,
            'temperature' => $request->temperature,
            'pulse' => $request->pulse,
            'lastTestedDate' => $request->lastTestedDate,
        ]);
        // Associate the health record with the authenticated user
        Auth::user()->healthRecords()->save($healthRecord);
    
        // Optionally, you can return a response or redirect back with a success message
        return redirect()->route('all-health.records')->with('message', 'Health record added successfully!');
    }

    public function getHealthRecords(Request $request)
    {
        $healthRecords = HealthRecord::where('user_id', auth()->id())
            ->orderBy('created_at')
            ->get();

        return response()->json($healthRecords);
    }
}
