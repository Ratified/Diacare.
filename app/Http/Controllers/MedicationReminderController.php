<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicationReminder;

class MedicationReminderController extends Controller
{
    public function index(){
        $reminders = auth()->user()->medicationReminders; 
        return view('medication-reminders.index', compact('reminders'));
    }

    // Show the form to create a new medication reminder
    public function create()
    {
        return view('medication-reminders.create');
    }

    // Store a newly created medication reminder in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'reminder_time' => 'required|date_format:H:i',
        ]);

        auth()->user()->medicationReminders()->create($request->all());

        return redirect()->route('medication.reminders')->with('message', 'Medication reminder created successfully.');
    }

    // Show the form to edit an existing medication reminder
    public function edit($id)
    {
        $reminder = MedicationReminder::findOrFail($id);
        return view('medication-reminders.edit', compact('reminder'));
    }

    // Update an existing medication reminder in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'reminder_time' => 'required|date_format:H:i',
        ]);

        $reminder = MedicationReminder::findOrFail($id);
        $reminder->update($request->all());

        return redirect()->route('medication.reminders')->with('message', 'Medication reminder updated successfully.');
    }

    // Remove the specified medication reminder from the database
    public function destroy($id)
    {
        $reminder = MedicationReminder::findOrFail($id);
        $reminder->delete();

        return redirect()->route('medication.reminders')->with('message', 'Medication reminder deleted successfully.');
    }
}
