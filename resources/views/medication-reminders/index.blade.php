<!-- resources/views/patient/medication-reminders.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Medication Reminders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4" style="color: #2EB4DE;">Manage Your Medication Reminders</h3>
                    <p class="mb-6">
                        Keeping track of your medication schedule is crucial for managing your health effectively. Diacare provides an easy way to set up reminders so you never miss a dose. Below, you can view your current medication reminders, or use the button to create a new one.
                    </p>

                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold" style="color: #2EB4DE;">Current Reminders</h4>
                        <a href="{{ route('medication-reminders.create') }}" class="text-blue-500 hover:text-blue-700">
                            Create New Reminder
                        </a>
                    </div>

                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                        Here are your existing medication reminders. You can edit or delete any reminder as needed.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            @foreach ($reminders as $reminder)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ $reminder->name }}</h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $reminder->description }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                            Time: {{ \Carbon\Carbon::parse($reminder->reminder_time)->format('h:i A') }}
                        </p>
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    Reminder Set : {{ \Carbon\Carbon::parse($reminder->created_at)->diffForHumans() }}
                                </p>
                            </div>
                            <div class="flex space-x-4">
                                <a href="{{ route('medication-reminders.edit', $reminder->id) }}" class="text-blue-500 hover:text-blue-700">
                                    Edit Reminder
                                </a>
                                <form action="{{ route('medication-reminders.destroy', $reminder->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reminder?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete Reminder</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <audio id="notificationSound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reminders = @json($reminders);
            const notificationSound = document.getElementById('notificationSound');

            const checkReminders = () => {
                const now = new Date().toTimeString().slice(0, 5);

                reminders.forEach(reminder => {
                    const reminderTime = new Date(reminder.reminder_time).toTimeString().slice(0, 5);
                    if (now === reminderTime) {
                        new Notification("Medication Reminder", {
                            body: `It's time to take your medication: ${reminder.name}`,
                        });
                        notificationSound.play();
                    }
                });
            };

            setInterval(checkReminders, 60000);

            if (Notification.permission !== "granted") {
                Notification.requestPermission().then(permission => {
                    if (permission === "granted") {
                        console.log("Notification permission granted.");
                    }
                });
            }
        });
    </script>
    <x-flash-message />
</x-app-layout>