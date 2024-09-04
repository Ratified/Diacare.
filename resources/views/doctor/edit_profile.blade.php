<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Your Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Update Your Profile</h3>
                    <p class="mb-6">
                        Modify the details below to update your profile. This information helps patients know more about you and your services.
                    </p>

                    <form action="{{ route('doctor.updateProfile', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Image Upload -->
                        <div class="form-group mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Image</label>
                            <small class="form-text text-muted">Upload your profile picture.</small>
                            <input type="file" id="image" name="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            @if ($doctor->image)
                                <img src="{{ Storage::url($doctor->image) }}" alt="Profile Image" class="mt-2 w-24 h-24 object-cover rounded-full">
                            @endif
                            @error('image')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="form-group mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <small class="form-text text-muted">Enter your full name.</small>
                            <input type="text" id="name" name="name" placeholder="Dr. John Doe" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ old('name', $doctor->name) }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Specialty -->
                        <div class="form-group mb-4">
                            <label for="specialty" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Specialty</label>
                            <small class="form-text text-muted">Specify your area of specialization.</small>
                            <input type="text" id="specialty" name="specialty" placeholder="Endocrinologist" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ old('specialty', $doctor->specialty) }}">
                            @error('specialty')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Availability Status -->
                        <div class="form-group mb-4">
                            <label for="availability_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Availability Status</label>
                            <small class="form-text text-muted">Indicate whether you are currently available for consultations.</small>
                            <select id="availability_status" name="availability_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                                <option value="1" {{ old('availability_status', $doctor->availability_status) == '1' ? 'selected' : '' }}>Available</option>
                                <option value="0" {{ old('availability_status', $doctor->availability_status) == '0' ? 'selected' : '' }}>Unavailable</option>
                            </select>
                            @error('availability_status')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="form-group mb-4">
                            <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                            <small class="form-text text-muted">Provide a brief biography.</small>
                            <textarea id="bio" name="bio" rows="4" placeholder="A short bio about yourself" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>{{ old('bio', $doctor->bio) }}</textarea>
                            @error('bio')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Qualifications -->
                        <div class="form-group mb-4">
                            <label for="qualifications" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Qualifications</label>
                            <small class="form-text text-muted">List your qualifications.</small>
                            <textarea id="qualifications" name="qualifications" rows="4" placeholder="Your qualifications" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>{{ old('qualifications', $doctor->qualifications) }}</textarea>
                            @error('qualifications')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Education -->
                        <div class="form-group mb-4">
                            <label for="education" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Education</label>
                            <small class="form-text text-muted">Provide your educational background.</small>
                            <textarea id="education" name="education" rows="4" placeholder="Your educational background" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>{{ old('education', $doctor->education) }}</textarea>
                            @error('education')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Experience -->
                        <div class="form-group mb-4">
                            <label for="experience" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Work Experience</label>
                            <small class="form-text text-muted">Describe your work experience.</small>
                            <textarea id="experience" name="experience" rows="4" placeholder="Your work experience" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>{{ old('experience', $doctor->experience) }}</textarea>
                            @error('experience')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fee -->
                        <div class="form-group mb-4">
                            <label for="fee" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Consultation Fee Per Hour (KES)</label>
                            <small class="form-text text-muted">Enter your consultation fee per hour.</small>
                            <input type="number" id="fee" name="fee" placeholder="2000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ old('fee', $doctor->fee) }}">
                            @error('fee')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Availability Times -->
                        <div class="form-group mb-4">
                            <label for="availabilities" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Availability Times</label>
                            <small class="form-text text-muted">Specify your available times for consultations.</small>
                            <div id="availabilityTimes">
                                @foreach ($doctor->availabilities as $index => $availability)
                                    <div class="availabilityTime flex items-center p-4 mb-4 border rounded-md">
                                        <div class="mr-4">
                                            <label class="block">Day:</label>
                                            <select name="availabilities[{{ $index }}][day]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                                                <option value="Monday" {{ old('availabilities.' . $index . '.day', $availability->day) == 'Monday' ? 'selected' : '' }}>Monday</option>
                                                <option value="Tuesday" {{ old('availabilities.' . $index . '.day', $availability->day) == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                                <option value="Wednesday" {{ old('availabilities.' . $index . '.day', $availability->day) == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                                <option value="Thursday" {{ old('availabilities.' . $index . '.day', $availability->day) == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                                <option value="Friday" {{ old('availabilities.' . $index . '.day', $availability->day) == 'Friday' ? 'selected' : '' }}>Friday</option>
                                                <option value="Saturday" {{ old('availabilities.' . $index . '.day', $availability->day) == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                                <option value="Sunday" {{ old('availabilities.' . $index . '.day', $availability->day) == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                                            </select>
                                        </div>
                                        <div class="mr-4">
                                            <label class="block">Start Time:</label>
                                            <input type="time" name="availabilities[{{ $index }}][start_time]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ old('availabilities.' . $index . '.start_time', $availability->start_time) }}">
                                        </div>
                                        <div>
                                            <label class="block">End Time:</label>
                                            <input type="time" name="availabilities[{{ $index }}][end_time]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ old('availabilities.' . $index . '.end_time', $availability->end_time) }}">
                                        </div>
                                        <button type="button" class="ml-4 text-red-600 hover:text-red-800" onclick="removeAvailability({{ $index }})">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="addAvailability" class="mt-4 text-indigo-600 hover:text-indigo-800">Add Another Time Slot</button>
                            @error('availabilities')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('doctor.updateProfile', ['id' => $doctor->id]) }}"
                                class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition">
                                 {{ __('Update Profile') }}
                             </a>                             
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function removeAvailability(index) {
            document.querySelector(`.availabilityTime:nth-of-type(${index + 1})`).remove();
        }

        document.getElementById('addAvailability').addEventListener('click', function() {
            const index = document.querySelectorAll('.availabilityTime').length;
            const container = document.getElementById('availabilityTimes');
            const html = `
                <div class="availabilityTime flex items-center p-4 mb-4 border rounded-md">
                    <div class="mr-4">
                        <label class="block">Day:</label>
                        <select name="availabilities[${index}][day]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="mr-4">
                        <label class="block">Start Time:</label>
                        <input type="time" name="availabilities[${index}][start_time]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                    </div>
                    <div>
                        <label class="block">End Time:</label>
                        <input type="time" name="availabilities[${index}][end_time]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                    </div>
                    <button type="button" class="ml-4 text-red-600 hover:text-red-800" onclick="removeAvailability(${index})">Remove</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });
    </script>
</x-app-layout>
