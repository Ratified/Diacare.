@extends('consultation.app')

@section('content')
    <h1 class="consultation_title">Schedule Consultation</h1>
    <div class="consultation_intro">
        <div class="consultation_intro__text">
            <p class="consultation_intro__main-text">Get expert diabetes treatment online with same-day prescription pickup from your local pharmacy.</p>

            <p class="consultation_intro__sub-text">Our doctors are experienced in treating diabetes and can help you manage your condition. Affordable, hassle-free video appointments for diabetes treatment from quality healthcare providers on your schedule.</p>

            <a href="#consultation_doctors" class="btn btn-medium" id="schedule-consultation-btn">Click To Schedule Consultation</a>
        </div>
        <div class="consultation_intro__image">
            <img src="{{ asset('images/consultation.jpg') }}" alt="Consultation Image">
        </div>
    </div>
    <div class="consultation_doctors" id="consultation_doctors">
        <h1 style="text-align: center; color: #007bff;" id="best-online-doctors-title">Best Online Doctors And Providers For Diabetes</h1>
        <div class="search">
            <input type="text" placeholder="Search for doctors" class="search_input" id="searchInput">
        </div>
        <div class="consultation_list" id="consultationList">
            @foreach ($doctors as $doctor)
                <div class="consultation_card" data-search="{{ strtolower($doctor->name) }} {{ strtolower($doctor->specialty) }}">
                    <div class="image_name-specialty">
                        <img src="{{ asset('storage/' . $doctor->image ) }}" alt="{{ $doctor->name }}" class="doctor_image">
                        <div>
                            <h2 class="doctor_name">
                                <a href="{{ route('doctor.profile', $doctor->id) }}" class="doctor_link">Dr. {{ $doctor->name }}</a>
                            </h2>
                            <p class="doctor_specialty">{{ $doctor->specialty }}</p>
                        </div>
                    </div>
                    <div class="availability_info">
                        <h3 class="availability_heading">Available Times:</h3>
                        <ul class="availability_times">
                            @foreach ($doctor->availabilities as $availability)
                                <li>{{ $availability->day }}: {{ date('g:i a', strtotime($availability->start_time)) }} - {{ date('g:i a', strtotime($availability->end_time)) }}</li>
                            @endforeach
                        </ul>
                        <p class="availability_status">
                            <span class="status_label">Status:</span> 
                            <span class="{{ $doctor->availability_status ? 'available' : 'unavailable' }}">
                                {{ $doctor->availability_status ? 'Available' : 'Unavailable' }}
                            </span>
                        </p>
                        @if($doctor->availability_status)
                            <a href="{{ route('appointments.create', $doctor->id) }}" class="btn btn-primary">Book Appointment</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="chatbot">
        <h2>Diabetes Information Chatbot</h2>
        <div id="chatbox"></div>
        <div class="input_container">
            <input type="text" id="userInput" placeholder="Type your message here..." />
            <button onclick="sendMessage()" class="btn" style="padding: 1rem 2rem">Send</button>
        </div>
    </div>
    <script>
       document.getElementById('schedule-consultation-btn').addEventListener('click', function() {
            document.getElementById('best-online-doctors-title').scrollIntoView({ behavior: 'smooth' });
        });

        const chatbox = document.getElementById('chatbox');
        const userInput = document.getElementById('userInput');

        async function sendMessage() {
            const message = userInput.value.trim();
            if (!message) return;

            // Display user's message
            const userMessageDiv = document.createElement('div');
            userMessageDiv.classList.add('chat_message', 'user_message');
            userMessageDiv.textContent = message;
            chatbox.appendChild(userMessageDiv);
            userInput.value = '';

            // Scroll to the bottom of the chatbox
            chatbox.scrollTop = chatbox.scrollHeight;

            // Send message to Diabot API
            try {
                const response = await fetch('http://localhost:3000/chat', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message }),
                });

                const data = await response.json();

                // Display Diabot's response
                const botMessageDiv = document.createElement('div');
                botMessageDiv.classList.add('chat_message', 'bot_message');
                botMessageDiv.textContent = data.reply;
                chatbox.appendChild(botMessageDiv);
                chatbox.scrollTop = chatbox.scrollHeight;
            } catch (error) {
                console.error('Error:', error);
                const errorMessageDiv = document.createElement('div');
                errorMessageDiv.classList.add('chat_message', 'bot_message');
                errorMessageDiv.textContent = 'Sorry, something went wrong.';
                chatbox.appendChild(errorMessageDiv);
                chatbox.scrollTop = chatbox.scrollHeight;
            }
        }

        document.querySelector('.btn').addEventListener('click', sendMessage);
        userInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') sendMessage();
        });

    </script>
@endsection