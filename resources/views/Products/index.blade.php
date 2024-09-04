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
            <li onclick="hideSideBar()"> href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a href="{{ route('products.index') }}">Diashop</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="/login">Login</a></li>
            <li><i class="fa-solid fa-cart-shopping"></i></li>
        </ul>
        <ul>
            <li><a href="{{ route('welcome') }}" class="diacare" >DIACARE</a></li>
            <li class="hideOnMobile"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="hideOnMobile"><a href="{{ route('products.index') }}">Diashop</a></li>
            <li class="hideOnMobile"><a href="{{ route('consultation.index') }}">Schedule Consultation</a></li>
            <li class="menu-button" onclick="showSideBar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
            <a class="cart inline" href="{{ route('cart.index') }}">
                <li><i class="fa-solid fa-cart-shopping"></i></li>
                <div class="cartAmount">
                    <?php
                        $userId = auth()->id();
                        $cartCount = \App\Models\Cart::where('user_id', $userId)->sum('quantity');
                        echo $cartCount;
                    ?>
                </div>
            </a>
        </ul>
    </nav>

    <main>
        <div class="diashop-text">
            <h1>DIASHOP PRODUCTS</h1>
            <p>Get Your Preferred products From Our Shop</p>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search products...">
            <button onclick="searchProducts()">Search</button>
        </div>
        
        <div class="product-container" id="shop">
        <div id="noResultsMessage" style="display: none;">Product not found!</div>

            @foreach ($products as $product)
                <div class="product">
                    @if($product->images->count() > 0)
                        <img src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }}" width="150">
                    @endif
                    
                    <h1>{{ $product->name }}</h1>
                    <p> <span class="definition">Category:</span> {{ $product->category }}</p>
                    <p><span class="definition">Price:</span> KES{{ $product->price }}</p>
                    
                    <p class="description" data-full-description="{{ $product->description }}">
                        {{ Str::limit($product->description, 150) }}
                        @if (strlen($product->description) > 150)
                            <span class="more-text" style="display: none;">{{ substr($product->description, 150) }}</span>
                            <a href="#" class="read-more">Read More</a>
                        @endif
                    </p>
                    
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="add-to-cart-btn">Add To Cart</button>
                    </form>                    
                    <a class="view-product" href="{{ route('products.show', $product->id) }}">View Product</a>
                </div>
            @endforeach
        </div>
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

    <x-flash-message />
    <script>
        //Search Bar Functionality
        function searchProducts() {
            const searchInput = document.getElementById('searchInput');
            const searchTerm = searchInput.value.toLowerCase();
            const products = document.querySelectorAll('.product');
            let productFound = false;

            products.forEach(product => {
                const productName = product.querySelector('h1').textContent.toLowerCase();
                const productCategory = product.querySelector('.definition').nextSibling.textContent.toLowerCase();
                if (productName.includes(searchTerm) || productCategory.includes(searchTerm)) {
                    product.style.display = 'block';
                    productFound = true;
                } else {
                    product.style.display = 'none';
                }
            });
            const noResultsMessage = document.getElementById('noResultsMessage');
            if (productFound) {
                noResultsMessage.style.display = 'none';
            } else {
                noResultsMessage.style.display = 'block';
            }
        
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

            // calculation(); 
            // initializeQuantities(); 
        });

        // Function to initialize product quantities from localStorage
        // function initializeQuantities() {
        //     let basket = JSON.parse(localStorage.getItem("data")) || [];
        //     basket.forEach(item => {
        //         const productQuantity = item.item;
        //         const productId = item.id;
        //         const quantityDisplay = document.getElementById(productId);
        //         if (quantityDisplay) {
        //             quantityDisplay.innerHTML = productQuantity;
        //         }
        //     });
        // }


        // let basket = JSON.parse(localStorage.getItem("data")) || [];

        // const increment = (id) => {
        //     let search = basket.find((x) => x.id === id);
        //     if (search === undefined) {
        //         basket.push({
        //             id: id,
        //             item: 1,
        //         });
        //     } else {
        //         search.item += 1;
        //     }
        //     localStorage.setItem("data", JSON.stringify(basket));
        //     update(id);
        // };

        // const decrement = (id) => {
        //     let search = basket.find((x) => x.id === id);
        //     if (search === undefined || search.item === 0) return;
        //     else {
        //         search.item -= 1;
        //     }
        //     localStorage.setItem("data", JSON.stringify(basket));
        //     update(id);
        // };

        // const update = (id) => {
        //     let search = basket.find((x) => x.id === id);
        //     document.getElementById(id).innerHTML = search.item;
        //     calculation();
        // };

        // const calculation = () => {
        //     const cartAmount = document.querySelector('.cartAmount');
        //     cartAmount.innerHTML = basket.map((x) => x.item).reduce((x, y) => x + y, 0);
        // };

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