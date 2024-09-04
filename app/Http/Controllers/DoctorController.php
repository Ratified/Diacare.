<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function setupProfile()
    {
        $doctor = Auth::user()->doctor;

        if ($doctor) {
            return redirect()->route('dashboard')->with('error', 'You have already set up your profile.');
        }

        return view('doctor.setup_profile');
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:doctors,email,',
            'specialty' => 'required|string|max:255',
            'bio' => 'required|string',
            'qualifications' => 'required|string',
            'education' => 'required|string',
            'experience' => 'required|string',
            'availability_status' => 'required|boolean',
            'fee' => 'required|integer|min:0',
            'availabilities.*.day' => 'required|string|max:255',
            'availabilities.*.start_time' => 'required',
            'availabilities.*.end_time' => 'required',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('uploads', 'public') : null;

        $doctor = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imagePath,
            'specialty' => $request->specialty,
            'availability_status' => $request->availability_status,
            'bio' => $request->bio,
            'qualifications' => $request->qualifications,
            'experience' => $request->experience,
            'education' => $request->education,
            'fee' => $request->fee,
            'user_id' => Auth::id(),  
        ]);

        foreach ($request->availabilities as $availability) {
            DoctorAvailability::create([
                'doctor_id' => $doctor->id,
                'day' => $availability['day'],
                'start_time' => $availability['start_time'],
                'end_time' => $availability['end_time'],
            ]);
        }

        return redirect()->route('dashboard')->with('message', 'Profile created successfully.');
    }


    public function editProfile($id)
    {
        $doctor = Doctor::with('availabilities')->findOrFail($id);

        if (Auth::id() !== $doctor->user_id) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to edit this profile.');
        }

        return view('doctor.edit_profile', compact('doctor'));
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'specialty' => 'required|string|max:255',
            'availability_status' => 'required|boolean',
            'bio' => 'required|string',
            'qualifications' => 'required|string',
            'experience' => 'required|string',
            'education' => 'required|string',
            'fee' => 'required|integer|min:0',
            'availabilities.*.day' => 'required|string|max:255',
            'availabilities.*.start_time' => 'required',
            'availabilities.*.end_time' => 'required',
        ]);

        $doctor = Doctor::findOrFail($id);

        if (Auth::id() !== $doctor->user_id) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to update this profile.');
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($doctor->image) {
                Storage::disk('public')->delete($doctor->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('uploads', 'public');
        } else {
            $imagePath = $doctor->image;
        }

        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imagePath,
            'specialty' => $request->specialty,
            'availability_status' => $request->availability_status,
            'bio' => $request->bio,
            'qualifications' => $request->qualifications,
            'experience' => $request->experience,
            'education' => $request->education,
            'fee' => $request->fee,
        ]);

        // Delete old availabilities
        $doctor->availabilities()->delete();

        // Create new availabilities
        foreach ($request->availabilities as $availability) {
            DoctorAvailability::create([
                'doctor_id' => $doctor->id,
                'day' => $availability['day'],
                'start_time' => $availability['start_time'],
                'end_time' => $availability['end_time'],
            ]);
        }

        return redirect()->route('dashboard')->with('message', 'Profile updated successfully.');
    }

    public function showProfile($id)
    {
        $doctor = Doctor::with('availabilities')->findOrFail($id);
        return view('doctor.profile', compact('doctor'));
    }

    public function deleteProfile($id)
    {
        $doctor = Doctor::findOrFail($id);

        if (Auth::id() !== $doctor->user_id) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to delete this profile.');
        }

        if ($doctor->image) {
            Storage::disk('public')->delete($doctor->image);
        }

        $doctor->delete();

        return redirect()->route('dashboard')->with('message', 'Profile deleted successfully.');
    }

    public function manageProfile()
    {
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            return redirect()->route('dashboard')->with('error', 'You have not set up your profile yet.');
        }

        return view('doctor.manage_profile', compact('doctor'));
    }
}