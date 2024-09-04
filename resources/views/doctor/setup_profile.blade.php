<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Set Up Your Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4"style="color: #2EB4DE;">Complete Your Profile Setup</h3>
                    <p class="mb-6">
                        Fill out the following details to set up your profile. This information helps patients know more about you and your services.
                    </p>

                    <form action="{{ route('doctor.storeProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Name</label>
                                <small class="form-text text-muted">Enter your full name.</small>
                                <input type="text" id="name" name="name" placeholder="Dr. John Doe" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ old('name', auth()->user()->name) }}">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Profile Picture -->
                            <div class="form-group">
                                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Profile Picture</label>
                                <small class="form-text text-muted">Upload a professional profile picture.</small>
                                <input type="file" id="image" name="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black">
                                @error('image')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Email</label>
                                <small class="form-text text-muted">Enter your email address.</small>
                                <input type="email" id="email" name="email" placeholder="you@example.com" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ old('email', auth()->user()->email) }}">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Specialty -->
                            <div class="form-group">
                                <label for="specialty" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Specialty</label>
                                <small class="form-text text-muted">Specify your area of specialization.</small>
                                <input type="text" id="specialty" name="specialty" placeholder="Endocrinologist" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ old('specialty') }}">
                                @error('specialty')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Bio -->
                            <div class="form-group col-span-2">
                                <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Bio</label>
                                <small class="form-text text-muted">Provide a brief biography.</small>
                                <textarea id="bio" name="bio" rows="4" placeholder="A short bio about yourself" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>{{ old('bio') }}</textarea>
                                @error('bio')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Qualifications -->
                            <div class="form-group col-span-2">
                                <label for="qualifications" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Qualifications</label>
                                <small class="form-text text-muted">List your qualifications.</small>
                                <textarea id="qualifications" name="qualifications" rows="4" placeholder="Your qualifications" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>{{ old('qualifications') }}</textarea>
                                @error('qualifications')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Education -->
                            <div class="form-group col-span-2">
                                <label for="education" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Education</label>
                                <small class="form-text text-muted">Provide your educational background.</small>
                                <textarea id="education" name="education" rows="4" placeholder="Your educational background" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>{{ old('education') }}</textarea>
                                @error('education')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Experience -->
                            <div class="form-group col-span-2">
                                <label for="experience" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Work Experience</label>
                                <small class="form-text text-muted">Describe your work experience.</small>
                                <textarea id="experience" name="experience" rows="4" placeholder="Your work experience" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>{{ old('experience') }}</textarea>
                                @error('experience')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Fee -->
                            <div class="form-group">
                                <label for="fee" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Consultation Fee Per Hour (KES)</label>
                                <small class="form-text text-muted">Enter your consultation fee per hour.</small>
                                <input type="number" id="fee" name="fee" placeholder="2000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ old('fee') }}">
                                @error('fee')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Availability Status -->
                            <div class="form-group">
                                <label for="availability_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Availability Status</label>
                                <small class="form-text text-muted">Indicate whether you are currently available for consultations.</small>
                                <select id="availability_status" name="availability_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                                    <option value="1" {{ old('availability_status') == '1' ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ old('availability_status') == '0' ? 'selected' : '' }}>Unavailable</option>
                                </select>
                                @error('availability_status')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Availability Times -->
                            <div class="form-group col-span-2">
                                <label for="availabilities" class="block text-sm font-medium text-gray-700 dark:text-gray-300"style="color: #2EB4DE;">Availability Times</label>
                                <small class="form-text text-muted">Specify your available times for consultations.</small>
                                <div id="availabilityTimes">
                                    @if (old('availabilities'))
                                        @foreach (old('availabilities') as $index => $availability)
                                            <div class="availabilityTime flex items-center p-4 mb-4 border rounded-md">
                                                <div class="mr-4">
                                                    <label class="block"style="color: #2EB4DE;">Day:</label>
                                                    <select name="availabilities[{{ $index }}][day]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                                                        <option value="Monday" {{ $availability['day'] == 'Monday' ? 'selected' : '' }}>Monday</option>
                                                        <option value="Tuesday" {{ $availability['day'] == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                                        <option value="Wednesday" {{ $availability['day'] == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                                        <option value="Thursday" {{ $availability['day'] == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                                        <option value="Friday"{{ $availability['day'] == 'Friday' ? 'selected' : '' }} >Friday</option>
                                                        <option value="Saturday" {{ $availability['day'] == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                                        <option value="Sunday" {{ $availability['day'] == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                                                    </select>
                                                </div>
                                                <div class="mr-4">
                                                    <label class="block">From:</label>
                                                    <input type="time" name="availabilities[{{ $index }}][start_time]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ $availability['from'] }}">
                                                </div>
                                                <div>
                                                    <label class="block">To:</label>
                                                    <input type="time" name="availabilities[{{ $index }}][end_time]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required value="{{ $availability['to'] }}">
                                                </div>
                                                <button type="button" class="ml-4 bg-red-500 text-white rounded-md p-2 removeAvailability">Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="availabilityTime flex items-center p-4 mb-4 border rounded-md">
                                            <div class="mr-4">
                                                <label class="block">Day:</label>
                                                <select name="availabilities[0][day]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
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
                                                <label class="block">From:</label>
                                                <input type="time" name="availabilities[0][from]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                                            </div>
                                            <div>
                                                <label class="block">To:</label>
                                                <input type="time" name="availabilities[0][to]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                                            </div>
                                            <button type="button" class="ml-4 bg-red-500 text-white rounded-md p-2 removeAvailability">Remove</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" id="addAvailability" class="mt-4 bg-green-500 text-white rounded-md p-2">Add Availability</button>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Save Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addAvailability').addEventListener('click', function() {
            const availabilityTimes = document.getElementById('availabilityTimes');
            const index = availabilityTimes.children.length;
            const div = document.createElement('div');
            div.className = 'availabilityTime flex items-center p-4 mb-4 border rounded-md';
            div.innerHTML = `
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
                    <label class="block">From:</label>
                    <input type="time" name="availabilities[${index}][start_time]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                </div>
                <div>
                    <label class="block">To:</label>
                    <input type="time" name="availabilities[${index}][endtime]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" required>
                </div>
                <button type="button" class="ml-4 bg-red-500 text-white rounded-md p-2 removeAvailability">Remove</button>
            `;
            availabilityTimes.appendChild(div);
        });
    
        document.getElementById('availabilityTimes').addEventListener('click', function(e) {
            if (e.target.classList.contains('removeAvailability')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</x-app-layout>
