<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diashop</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/ce2d94b0f6.js" crossorigin="anonymous"></script>
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
    <nav class="nav">
        <ul class="sidebar">
            <li onclick="hideSideBar()"><a style="color: black;" href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a style="color: black;" href="#">Home</a></li>
            <li><a style="color: black;" href="#">About</a></li>
            <li><a style="color: black;" href="#">Services</a></li>
            <li><a style="color: black;" href="{{ route('products.index') }}">Diashop</a></li>
            <li><a style="color: black;" href="#contact">Contact</a></li>
            <li><a style="color: black;" href="/login">Login</a></li>
            <li><i class="fa-solid fa-cart-shopping"></i></li>
        </ul>
        <ul style="color: black;">
            <li><a style="color: black;" href="{{ route('welcome') }}">DIACARE</a></li>
            <li class="hideOnMobile"><a style="color: black;" href="#">Home</a></li>
            <li class="hideOnMobile"><a style="color: black;" href="{{ route('products.index') }}">Diashop</a></li>
            <li class="hideOnMobile"><a style="color: black;" href="/login">Login</a></li>
            <li class="menu-button" onclick="showSideBar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>

    <main>
        <div class="diashop-text">
            <h1>DIASHOP PRODUCTS</h1>
            <p>Get All Your Preferred Meds From Our Shop</p>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search products...">
            <button onclick="searchProducts()">Search</button>
        </div>

        <div class="product-container" id="shop">
            @foreach ($products as $product)
                <div class="product">
                    @if ($product->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/glucometer/One Touch Blood Glucose Meter.jpg') }}" alt="{{ $product->name }}">
                    @endif
                    
                    <h1>{{ $product->name }}</h1>
                    <p><span class="definition">Category:</span> {{ $product->category }}</p>
                    <p><span class="definition">Price:</span> USD{{ $product->price }}</p>
                    
                    <p class="description" data-full-description="{{ $product->description }}">
                        {{ Str::limit($product->description, 150) }}
                        @if (strlen($product->description) > 150)
                            <span class="more-text" style="display: none;">{{ substr($product->description, 150) }}</span>
                            <a href="#" class="read-more">Read More</a>
                        @endif
                    </p>
                    
                    <div class="buttons">
                        <a href="{{ route('admin.products.editPage', $product->id) }}" style="text-decoration: none; background-color: #333; color: white; padding: 10px 15px; border-radius: 5px;">Edit</a>
                        <form action="{{ route('admin.products.delete', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #c8102e; border: none; color: white; padding: 5px 20px; border-radius: 5px;">Delete</button>
                        </form>
                    </div>
                    
                    <a class="view-product" href="{{ route('products.show', $product->id) }}">View Product</a>
                </div>
            @endforeach
        </div>
        
    </main>

    <x-flash-message />
    <script>
        //Search Bar Functionality
        function searchProducts() {
            const searchInput = document.getElementById('searchInput');
            const searchTerm = searchInput.value.toLowerCase();
            const products = document.querySelectorAll('.product');

            products.forEach(product => {
                const productName = product.querySelector('h1').textContent.toLowerCase();
                const productCategory = product.querySelector('.definition').nextSibling.textContent.toLowerCase();
                if (productName.includes(searchTerm) || productCategory.includes(searchTerm)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        // Toggle the navbar in mobile and web devices
        function showSideBar() {
            const sidebar = document.querySelector(".sidebar");
            sidebar.style.display = 'flex';
        }

        function hideSideBar() {
            const sidebar = document.querySelector(".sidebar");
            sidebar.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const readMoreLinks = document.querySelectorAll('.read-more');

            readMoreLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const description = this.closest('.description');
                    const moreText = description.querySelector('.more-text');

                    if (moreText.style.display === 'none') {
                        moreText.style.display = 'inline';
                        this.textContent = 'See Less';
                    } else {
                        moreText.style.display = 'none';
                        this.textContent = 'Read More';
                    }
                });
            });

        });

        // GSAP
        gsap.registerPlugin(ScrollTrigger);

        gsap.utils.toArray('.product').forEach(product => {
            gsap.from(product, {
                x: -100,
                opacity: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: product,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none none'
                }
            });
        });
    </script>
</body>
</html>
