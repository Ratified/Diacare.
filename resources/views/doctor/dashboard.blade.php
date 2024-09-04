<!-- resources/views/doctor/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Doctor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Quick Stats -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-black dark:text-white"style="color: #2EB4DE;">DASHBOARD OVERVIEW</h3>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <div class="bg-gray-200 p-4 rounded-lg">
                        <h4 class="font-medium"style="color: #2EB4DE;">Upcoming Appointments</h4>
                        @if(isset($appointments) && $appointments->count() > 0)
                            <ul>
                                @foreach($appointments as $appointment)
                                    <li class="mb-4">
                                        <strong>Patient:</strong> {{ $appointment->user->name }} <br>
                                        <strong>Date:</strong> {{ $appointment->date }} <br>
                                        <strong>Time:</strong> {{ $appointment->time }} <br>
                                        <div id="timer-{{ $appointment->id }}" class="timer" data-time="{{ $appointment->date }} {{ $appointment->time }}"></div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No upcoming appointments.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Profile and Consultation Management -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6">
                    @if (Auth::user()->doctor)
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                            <a href="{{ route('manage-profile') }}">Manage Your Profile</a>
                        </p>
                    @else
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                            <a href="{{ route('setup-profile') }}"style="color: #2EB4DE;">Set Up Your Profile</a>
                        </p>
                    @endif
                    <!-- Additional management options here -->
                </div>
            </div>
        </div>
    </div>

    <audio id="notificationSound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timers = document.querySelectorAll('.timer');
            const notificationSound = document.getElementById('notificationSound');

            timers.forEach(timer => {
                const appointmentTime = new Date(timer.getAttribute('data-time'));
                const appointmentId = timer.id;

                const countdown = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = appointmentTime - now;

                    if (distance < 0) {
                        clearInterval(countdown);
                        timer.innerHTML = "It's time for your appointment!";
                        notificationSound.play();
                        new Notification("Appointment Reminder", {
                            body: "It's time for your appointment!",
                        });
                    } else {
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        timer.innerHTML = `${hours}h ${minutes}m ${seconds}s `;
                    }
                }, 1000);
            });
        });

        if (Notification.permission !== "granted") {
            Notification.requestPermission().then(permission => {
                if (permission === "granted") {
                    console.log("Notification permission granted.");
                }
            });
        }
    </script>
</x-app-layout>