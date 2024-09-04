<?php
use App\Models\MedicationReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();      

// Medication Reminder Scheduled
app(Schedule::class)->call(function () {
    $now = now()->format('H:i');
    $reminders = MedicationReminder::where('reminder_time', $now)->get();

    foreach ($reminders as $reminder) {
        $user = $reminder->user;
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\MedicationReminderMail($reminder));
    }
})->everyMinute();  
