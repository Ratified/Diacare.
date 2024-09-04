<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/consultation.css') }}">
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

      <!-- Fontawesome -->
      <script src="https://kit.fontawesome.com/ce2d94b0f6.js" crossorigin="anonymous"></script>
    <title>Consultation</title>
</head>
<body>
    <nav class="nav">
        <ul class="sidebar">
            <li onclick="hideSideBar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a href="{{ route('products.index') }}">Diashop</a></li>
            @auth
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
            <li><a href="{{ route('welcome') }}" class="diacare">DIACARE</a></li>
            @auth 
                <li class="hideOnMobile"><a href="{{ route('products.index') }}">Diashop</a></li>
                <li class="hideOnMobile"><a href="">Schedule Consultation</a></li>
                <form action="{{ route('logout') }}" method="POST">
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

    <main>
        @yield('content')
    </main>

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
</body>
</html>