<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Medication Reminder') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Edit Medication Reminder</h3>

                    <form action="{{ route('medication-reminders.update', $reminder->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reminder Name</label>
                            <input type="text" name="name" id="name" value="{{ $reminder->name }}" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description (optional)</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full text-black">{{ $reminder->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="reminder_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reminder Time</label>
                            <input type="time" name="reminder_time" id="reminder_time" value="{{ \Carbon\Carbon::parse($reminder->reminder_time)->format('H:i') }}" class="mt-1 block w-full text-black" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Reminder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>