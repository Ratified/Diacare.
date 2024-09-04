<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> --}}
    <title>{{ $product->name }}</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .product {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .product-images {
            flex: 1 1 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .main-image img {
            width: 100%;
            max-width: 400px;
            height: auto;
            object-fit: cover;
        }
        .thumbnail-images {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        .thumbnail-images img {
            cursor: pointer;
            width: 50px;
            height: 50px;
            object-fit: cover;
            border: 2px solid transparent;
            transition: border-color 0.3s ease;
        }
        .thumbnail-images img:hover {
            border-color: #333;
        }
        .product-details {
            flex: 1 1 50%;
            padding-left: 20px;
        }
        .product-details h1 {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .product-details p {
            margin-top: 0;
            margin-bottom: 10px;
        }
        .product-details .description {
            margin-bottom: 20px;
        }
        .product-details .price {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .actions {
            display: flex;
            align-items: center;
        }
        .actions button,
        .actions a {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .actions button:hover,
        .actions a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    

    <main>
        <div class="container">
            <div class="product">
                <div class="product-images">
                    <div class="main-image">
                        @if($product->images->count() > 0)
                            <img src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }}" id="main-product-image">
                        @endif
                    </div>
                    <div class="thumbnail-images">
                        @foreach ($product->images as $image)
                            <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }}" onclick="changeMainImage('{{ asset($image->image_path) }}')">
                        @endforeach
                    </div>
                </div>
                <div class="product-details">
                    <h1>{{ $product->name }}</h1>
                    <div class="description">
                        <p>{{ $product->description }}</p>
                    </div>
                    <p class="category">Category: {{ $product->category }}</p>
                    <p class="price">Price: KSh{{ $product->price }}</p>
                    <div class="actions">
                        <button onclick="addToCart()">Add to Cart</button>
                        {{-- <a href="{{ route('checkout') }}">Proceed to Checkout</a> --}}
                        <a>Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    

    <script>
        function changeMainImage(imageSrc) {
            document.getElementById('main-product-image').src = imageSrc;
        }

        function addToCart() {
            // Add logic to add the product to the cart
            alert("Product added to cart!");
        }
    </script>
</body>
</html>
