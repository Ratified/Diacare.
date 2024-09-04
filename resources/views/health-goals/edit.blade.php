<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Health Goal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Edit Your Health Goal</h3>
                    
                    <!-- Display any validation errors -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('health-goals.update', $goal->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full text-black" value="{{ old('title', $goal->title) }}" required autofocus>
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full text-black" required>{{ old('description', $goal->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="target_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Target Date</label>
                            @php
                                $formattedDate = $goal->target_date ? \Carbon\Carbon::parse($goal->target_date)->format('Y-m-d') : '';
                            @endphp
                            <input type="date" name="target_date" id="target_date" class="mt-1 block w-full text-black" value="{{ old('target_date', $formattedDate) }}" required>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('health-goals.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 mr-4">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Goal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>