<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Health Tracker') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Track Your Health Metrics</h3>
                    <p class="mb-6">
                        Please fill out the following details to track your health metrics for today.
                    </p>

                    <form action="{{ route('health-tracker.store') }}" method="POST" class="grid grid-cols-1 gap-6">
                        @csrf
                           <!-- Diabetes Type -->
                           {{-- <div class="form-group">
                            <label for="diabetes_type" class="block text-base font-medium text-gray-700 dark:text-gray-300">Diabetes Type</label>
                            <small class="form-text text-muted">Select the type of diabetes you have.</small>
                            <select name="diabetes_type" id="diabetes_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                                <option value="Type 1" {{ old('diabetes_type') == 'Type 1' ? 'selected' : '' }}>Type 1</option>
                                <option value="Type 2" {{ old('diabetes_type') == 'Type 2' ? 'selected' : '' }}>Type 2</option>
                                <option value="Gestational" {{ old('diabetes_type') == 'Gestational' ? 'selected' : '' }}>Gestational</option>
                                <option value="Prediabetes" {{ old('diabetes_type') == 'Prediabetes' ? 'selected' : '' }}>Prediabetes</option>
                                <option value="Other" {{ old('diabetes_type') == 'Other' ? 'selected' : '' }}>Other</option>
                        </div> --}}

                        <!-- Weight -->
                        <div class="form-group">
                            <label for="weight" class="block text-base font-medium text-gray-700 dark:text-gray-300">Weight (kg)</label>
                            <small class="form-text text-muted">e.g., 65.5. Your weight helps us monitor changes in your body mass.</small>
                            <input type="number" step="0.01" name="weight" id="weight" value="{{ old('weight') }}" placeholder="e.g., 65.5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            @error('weight')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Height -->
                        <div class="form-group">
                            <label for="height" class="block text-base font-medium text-gray-700 dark:text-gray-300">Height (cm)</label>
                            <small class="form-text text-muted">e.g., 175. Height helps calculate your BMI and assess overall health.</small>
                            <input type="number" step="0.01" name="height" id="height" value="{{ old('height') }}" placeholder="e.g., 175" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            @error('height')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Systolic Pressure -->
                        <div class="form-group">
                            <label for="systolic_pressure" class="block text-base font-medium text-gray-700 dark:text-gray-300">Systolic Pressure (mmHg)</label>
                            <small class="form-text text-muted">e.g., 120. Measures the pressure when your heart beats.</small>
                            <input type="number" name="systolic_pressure" id="systolic_pressure" value="{{ old('systolic_pressure') }}" placeholder="e.g., 120" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            @error('systolic_pressure')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Diastolic Pressure -->
                        <div class="form-group">
                            <label for="diastolic_pressure" class="block text-base font-medium text-gray-700 dark:text-gray-300">Diastolic Pressure (mmHg)</label>
                            <small class="form-text text-muted">e.g., 80. Measures the pressure when your heart rests between beats.</small>
                            <input type="number" name="diastolic_pressure" id="diastolic_pressure" value="{{ old('diastolic_pressure') }}" placeholder="e.g., 80" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            @error('diastolic_pressure')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Blood Sugar -->
                        <div class="form-group">
                            <label for="blood_sugar" class="block text-base font-medium text-gray-700 dark:text-gray-300">Blood Sugar (mmol/L)</label>
                            <small class="form-text text-muted">e.g., 5.5. Measures your blood sugar level for diabetes management.</small>
                            <input type="number" step="0.01" name="blood_sugar" id="blood_sugar" value="{{ old('blood_sugar') }}" placeholder="e.g., 5.5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            @error('blood_sugar')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cholesterol -->
                        <div class="form-group">
                            <label for="cholesterol" class="block text-base font-medium text-gray-700 dark:text-gray-300">Cholesterol (mmol/L)</label>
                            <small class="form-text text-muted">e.g., 4.0. Helps assess your risk of heart disease.</small>
                            <input type="number" step="0.01" name="cholesterol" id="cholesterol" value="{{ old('cholesterol') }}" placeholder="e.g., 4.0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            @error('cholesterol')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Temperature -->
                        <div class="form-group">
                            <label for="temperature" class="block text-base font-medium text-gray-700 dark:text-gray-300">Temperature (°C)</label>
                            <small class="form-text text-muted">e.g., 37.0. Helps monitor any fever or abnormal body temperature.</small>
                            <input type="number" step="0.01" name="temperature" id="temperature" value="{{ old('temperature') }}" placeholder="e.g., 37.0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            @error('temperature')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pulse -->
                        <div class="form-group">
                            <label for="pulse" class="block text-base font-medium text-gray-700 dark:text-gray-300">Pulse (bpm)</label>
                            <small class="form-text text-muted">e.g., 75. Measures your heart rate for overall cardiovascular health.</small>
                            <input type="number" name="pulse" id="pulse" value="{{ old('pulse') }}" placeholder="e.g., 75" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            @error('pulse')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Test Date -->
                        <div class="form-group">
                            <label for="lastTestedDate" class="block text-base font-medium text-gray-700 dark:text-gray-300">Last Test Date</label>
                            <small class="form-text text-muted">Select the date of your last test to track changes over time.</small>
                            <input type="date" name="lastTestedDate" id="lastTestedDate" value="{{ old('lastTestedDate') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            @error('lastTestedDate')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>