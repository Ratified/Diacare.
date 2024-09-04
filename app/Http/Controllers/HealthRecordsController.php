<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthRecordsController extends Controller
{
    public function index(){
        $latestHealthRecord = Auth::user()->healthRecords()->latest()->first();
    
        if ($latestHealthRecord) {
            $latestHealthRecord->lastTestedDate = Carbon::parse($latestHealthRecord->lastTestedDate);
        }
    
        return view('health-records.index', [
            'latestHealthRecord' => $latestHealthRecord
        ]);
    }
}
