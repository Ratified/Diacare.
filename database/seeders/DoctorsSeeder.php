<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\DoctorAvailability;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Doctor 1
        $doctor1 = Doctor::create([
            'name' => 'Dr. Jane Smith',
            'email' => 'jane.smith@example.com',
            'image' => 'uploads/jane_smith.jpg',  // Adjust the path as necessary
            'specialty' => 'Endocrinologist',
            'availability_status' => true,
        ]);

        // Creating availabilities for Doctor 1
        DoctorAvailability::createMany([
            ['doctor_id' => $doctor1->id, 'day' => 'Monday', 'start_time' => '09:00', 'end_time' => '17:00'],
            ['doctor_id' => $doctor1->id, 'day' => 'Wednesday', 'start_time' => '09:00', 'end_time' => '17:00'],
            ['doctor_id' => $doctor1->id, 'day' => 'Friday', 'start_time' => '09:00', 'end_time' => '15:00'],
        ]);

        // Creating Doctor 2
        $doctor2 = Doctor::create([
            'name' => 'Dr. John Doe',
            'email' => 'john.doe@example.com',
            'image' => 'uploads/john_doe.jpg',  // Adjust the path as necessary
            'specialty' => 'Diabetologist',
            'availability_status' => false,
        ]);

        // Creating availabilities for Doctor 2
        DoctorAvailability::createMany([
            ['doctor_id' => $doctor2->id, 'day' => 'Tuesday', 'start_time' => '10:00', 'end_time' => '18:00'],
            ['doctor_id' => $doctor2->id, 'day' => 'Thursday', 'start_time' => '10:00', 'end_time' => '18:00'],
            ['doctor_id' => $doctor2->id, 'day' => 'Saturday', 'start_time' => '10:00', 'end_time' => '14:00'],
        ]);

        // Creating Doctor 3
        $doctor3 = Doctor::create([
            'name' => 'Dr. Emily Johnson',
            'email' => 'emily.johnson@example.com',
            'image' => 'uploads/emily_johnson.jpg',  // Adjust the path as necessary
            'specialty' => 'Primary Care Physician',
            'availability_status' => true,
        ]);

        // Creating availabilities for Doctor 3
        DoctorAvailability::createMany([
            ['doctor_id' => $doctor3->id, 'day' => 'Monday', 'start_time' => '08:00', 'end_time' => '16:00'],
            ['doctor_id' => $doctor3->id, 'day' => 'Thursday', 'start_time' => '08:00', 'end_time' => '16:00'],
            ['doctor_id' => $doctor3->id, 'day' => 'Friday', 'start_time' => '08:00', 'end_time' => '13:00'],
        ]);
    }
}