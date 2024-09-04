<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/reset.css')}}">
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">

        <title>Diacare</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Fontawesome -->
        <script src="https://kit.fontawesome.com/ce2d94b0f6.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <x-flash-message />
        <header class="header" id="header">
            <nav class="nav">
                <ul class="sidebar">
                    <li onclick="hideSideBar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
                    <li><a href="{{ route('products.index') }}">Diashop</a></li>
                    @auth
                        <li>Welcome {{auth()->user()->name}}</li>
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    @else 
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                    @endauth
                </ul> 
                <ul>
                    <li><a href="#" class="diacare">DIACARE</a></li>
                    @auth 
                        <li class="hideOnMobile"><a href="#">Welcome {{auth()->user()->name}}</a></li>
                        <li class="hideOnMobile"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="hideOnMobile"><a href="{{ route('products.index') }}">Diashop</a></li>
                        <li class="hideOnMobile"><a href="{{ route('consultation.index') }}">Schedule Consultation</a></li>
                        {{-- <li class="hideOnMobile"><a href="{{ route('logout') }}">Logout</a></li> --}}
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hideOnMobile-logout">Logout</button>
                        </form>
                    @else 
                        <li class="hideOnMobile"><a href="/login">Login</a></li>
                        <li class="hideOnMobile"><a href="/register">Register</a></li>
                    @endauth
                    <li class="menu-button" onclick="showSideBar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
                </ul>
            </nav>
    
            <div class="hero-section">
                <div class="hero-section__text">
                    <h1>Manage Your Diabetes</h1>
                    <p>Managing diabetes requires dedication, commitment, and continuous learning.
                    By taking proactive steps to manage your condition, you can lead a fulfilling and healthy life
                    Stay informed, stay active, and stay empowered to take control of your health.</p>
                    @guest
                    <a href="{{ route('register') }}" >
                        <button class="btn btn-large">Join Us</button>
                    </a>
                    @else 
                        <a href="{{ route('dashboard') }}" class="btn btn-large">Dashboard</a>
                    @endguest
                </div>
            </div>
        </header>
        <div class="home">
        <main>
            <section id="about">
                <h2>About Us</h2>
                <div class="about-section">
                    <img class="about-section__image" src="{{asset('images/aboutsection.png')}}" alt="About Us">
                    <div class="about-section__text">
                        <p>Diabetes is a chronic disease that occurs when the body can no longer produce insulin or use it effectively. Insulin is a hormone that regulates blood sugar. Hyperglycemia, or high blood sugar, is a common effect of uncontrolled diabetes and over time leads to serious damage to many of the body's systems, especially the nerves and blood vessels.</p>
                    </div>
                </div>
            </section>

            <section id="services">
                <h2>Our Services</h2>
                <div class="services-container">
                    <div class="service-box">
                        <img src="{{asset('images/healthtracker.png')}}" alt="Health Tracking">
                        <h3>Health Tracking</h3>
                        <p>Monitor your health and track your diabetes with our comprehensive health tracking tools.</p>
                    </div>
                    <div class="service-box">
                        <img src="{{asset('images/consultation.png')}}" alt="Consultation Services">
                        <h3>Consultation Services</h3>
                        <p>Get professional advice and support from our team of diabetes specialists.</p>
                    </div>
                    <div class="service-box">
                        <img src="{{asset('images/diashop.png')}}" alt="Diashop">
                        <h3>Diashop</h3>
                        <p>Shop for diabetes medications and supplies at our convenient online store, Diashop.</p>
                    </div>
                </div>
            </section>

            <section id="contact">
                <h2>Contact Us</h2>
                <div class="contact-form-container">
                    <form class="contact-form" id="contactForm" action="{{ route('contact.submit') }}" method="POST" novalidate>
                        @csrf
                        <div>
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </section>            
        </main>
</div>
        <footer id="footer">
            <div class="footer-container">
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <p>Email: diacare@gmail.com</p>
                    <p>Phone: 0716980741</p>
                    <p>Address: Nairobi, Kenya</p>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Follow Us</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <p>&copy; Diacare. All rights reserved.</p>
        </footer>

        <script>
            function showSideBar(){
                const sidebar = document.querySelector(".sidebar")
                sidebar.style.display = 'flex';
            }
            function hideSideBar(){
                const sidebar = document.querySelector(".sidebar")
                sidebar.style.display = 'none'
            }

            // document.getElementById('contactForm').addEventListener('submit', function(event) {
            //     event.preventDefault();

            //     const form = event.target;
            //     const formData = new FormData(form);

            //     fetch(form.action, {
            //         method: 'POST',
            //         headers: {
            //             'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            //             'Accept': 'application/json',
            //         },
            //         body: formData,
            //     })
            //     .then(response => response.json())
            //     .then(data => {
            //         if (data.success) {
            //             alert(data.success);
            //             form.reset();
            //         } else {
            //             // Handle validation errors
            //             if (data.errors) {
            //                 for (const [field, messages] of Object.entries(data.errors)) {
            //                     document.getElementById(field + 'Error').textContent = messages.join(', ');
            //                 }
            //             }
            //         }
            //     })
            //     .catch(error => {
            //         console.error('Error:', error);
            //     });
            // });
        </script>
    </body>
</html>
