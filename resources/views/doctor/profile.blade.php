<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Doctor Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="border p-4 mb-4">
                        <div class="mb-4">
                            <img src="{{ $doctor->image ? asset('storage/' . $doctor->image) : 'default-image.jpg' }}" alt="Profile Image" class="w-32 h-32 object-cover rounded-full">
                        </div>
                        <h3 class="text-xl font-semibold">Dr. {{ $doctor->name }}</h3>
                        <p><strong>Email:</strong> {{ $doctor->email }}</p>
                        <p><strong>Specialty:</strong> {{ $doctor->specialty }}</p>
                        <p><strong>Bio:</strong> {{ $doctor->bio }}</p>
                        <p><strong>Qualifications:</strong> {{ $doctor->qualifications }}</p>
                        <p><strong>Education:</strong> {{ $doctor->education }}</p>
                        <p><strong>Experience:</strong> {{ $doctor->experience }}</p>
                        <p><strong>Consultation Fee:</strong> KES {{ $doctor->fee }}</p>
                        <p><strong>Availability Status:</strong> {{ $doctor->availability_status ? 'Available' : 'Unavailable' }}</p>
                        <p><strong>Availability Times:</strong></p>
                        <ul>
                            @foreach ($doctor->availabilities as $availability)
                                <li>{{ $availability->day }}: {{ date('g:i a', strtotime($availability->start_time)) }} - {{ date('g:i a', strtotime($availability->end_time)) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>