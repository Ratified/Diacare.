<!-- resources/views/appointments/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Appointment with Dr. ') . $doctor->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Book Appointment</h3>
                    <p class="mb-6">
                        Schedule an appointment with Dr. {{ $doctor->name }}. Please select a date and time from the available slots.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger mb-6">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('availability_error'))
                        <div class="alert alert-danger mb-6">
                            <p class="text-red-500">{{ session('availability_error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <!-- Date -->
                            <div class="form-group">
                                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                                <input type="date" name="date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            </div>

                            <!-- Time -->
                            <div class="form-group">
                                <label for="time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Time</label>
                                <input type="time" name="time" id="time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Doctor's Available Times</label>
                            <ul class="list-disc pl-5">
                                @foreach($doctor->availabilities as $availability)
                                    <li>{{ $availability->day }}: {{ date('h:i A', strtotime($availability->start_time)) }} - {{ date('h:i A', strtotime($availability->end_time)) }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Book Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>