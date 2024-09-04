<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Models\HealthRecord;
use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function index()
{
    $latestHealthRecord = Auth::user()->healthRecords()->latest()->first();
    
    if ($latestHealthRecord) {
        $latestHealthRecord->lastTestedDate = Carbon::parse($latestHealthRecord->lastTestedDate);
    }

    return view('dashboard', [
        'latestHealthRecord' => $latestHealthRecord
    ]);
}
    
}
