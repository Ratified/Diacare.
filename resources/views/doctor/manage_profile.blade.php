<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (!$doctor)
                        <p>You have not set up your profile yet. <a href="{{ route('setup-profile') }}" class="text-blue-500">Set up your profile</a>.</p>
                    @else
                        <div class="border p-4 mb-4">
                            <!-- Displaying the doctor's image -->
                            <div class="mb-4">
                                <img src="{{ $doctor->image ? asset('storage/' . $doctor->image) : 'default-image.jpg' }}" alt="Profile Image" class="w-32 h-32 object-cover rounded-full">
                            </div>
                            
                            <h3 class="text-xl font-semibold">{{ $doctor->name }}</h3>
                            <p><strong>Email:</strong> {{ $doctor->email }}</p>
                            <p><strong>Specialty:</strong> {{ $doctor->specialty }}</p>
                            <p><strong>Availability Status:</strong> {{ $doctor->availability_status ? 'Available' : 'Unavailable' }}</p>
                            <p><strong>Availability Times:</strong></p>
                            <ul>
                                @foreach ($doctor->availabilities as $availability)
                                    <li>{{ $availability->day }}: {{ $availability->start_time }} - {{ $availability->end_time }}</li>
                                @endforeach
                            </ul>
                            <!-- Adding new fields -->
                            <p><strong>Bio:</strong> {{ $doctor->bio }}</p>
                            <p><strong>Qualifications:</strong> {{ $doctor->qualifications }}</p>
                            <p><strong>Education:</strong> {{ $doctor->education }}</p>
                            <p><strong>Experience:</strong> {{ $doctor->experience }}</p>
                            <p><strong>Fee:</strong> KES {{ number_format($doctor->fee, 2) }}</p>
                            <!-- Actions -->
                            <div class="mt-4">
                                <a href="{{ route('doctor.editProfile', $doctor->id) }}" class="text-blue-500">Edit Profile</a> | 
                                <form action="{{ route('doctor.deleteProfile', $doctor->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="text-red-500">Delete Profile</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-flash-message />
</x-app-layout>