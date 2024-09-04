<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Medication Reminder') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Create a New Medication Reminder</h3>

                    <form action="{{ route('medication-reminders.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reminder Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full text-black" placeholder="Metformin" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description (optional)</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full text-black" placeholder="500mg orally"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="reminder_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reminder Time</label>
                            <input type="time" name="reminder_time" id="reminder_time" class="mt-1 block w-full text-black" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save Reminder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
