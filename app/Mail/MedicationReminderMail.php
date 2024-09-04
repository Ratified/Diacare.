<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\MedicationReminder;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class MedicationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reminder;

    /**
     * Create a new message instance.
     *
     * @param  MedicationReminder  $reminder
     * @return void
     */
    public function __construct(MedicationReminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Medication Reminder Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('emails.medication_reminder')
                    ->with([
                        'reminderName' => $this->reminder->name,
                        'reminderDescription' => $this->reminder->description,
                        'reminderTime' => $this->reminder->reminder_time->format('h:i A'),
                    ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments()
    {
        return [];
    }
}