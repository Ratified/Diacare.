<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submitForm(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        Mail::to('kamungegeorge43@gmail.com')->send(new ContactFormSubmitted($details));

        return redirect()->back()->with('message', 'Thank you for contacting us! We will get back to you shortly.');
    }
}
