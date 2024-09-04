<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Patient Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4" style="color: #2EB4DE;">Welcome to Your Dashboard</h3>
                    <p>
                        Here, you can manage and monitor your health records, set health goals, and manage medication reminders. Use the links below to navigate to the different sections of your dashboard.
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <a href="{{ route('all-health.records') }}" class="text-lg font-semibold mb-4" style="color:#2EB4DE;">Health Records</a>
                        <p class="text-gray-500">
                            View and manage your complete health history, including past consultations, medical reports, and lab results.
                        </p>
                    </div>

                    <div>
                        <a href="{{ route('health-goals.index') }}" class="text-lg font-semibold mt-8 mb-4"style="color: #2EB4DE;">Health Goals </a>
                        <p class="text-gray-500">
                            Set and track your health goals to stay on top of your wellness journey. You can create, edit, and monitor your progress towards achieving your health objectives.
                        </p>
                    </div>

                    <div>
                        <a href="{{ route('medication.reminders') }}" class="text-lg font-semibold mt-8 mb-4"style="color: #2EB4DE;">Medication Reminders</a>
                        <p class="text-gray-500">
                            Manage your medication schedule with reminders. Ensure you never miss a dose by setting up and managing your medication reminders here.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4"style="color: #2EB4DE;">Upcoming Appointments</h3>
                    <ul>
                        @foreach($appointments as $appointment)
                            <li class="mb-4">
                                <strong>Doctor:</strong> Dr. {{ $appointment->doctor->name }} <br>
                                <strong>Date:</strong> {{ $appointment->date }} <br>
                                <strong>Time:</strong> {{ $appointment->time }} <br>
                                <div id="timer-{{ $appointment->id }}" class="timer" data-time="{{ $appointment->date }} {{ $appointment->time }}"></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <audio id="notificationSound" src="{{ asset('sounds/notification.wav') }}" preload="auto"></audio>

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
                        timer.innerHTML = "Make sure you don't miss your appointment!";
                        notificationSound.play();
                        new Notification("Appointment Reminder", {
                            body: "Remember your appointment!",
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