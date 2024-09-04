<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'On Class Plus II Blood Glucose Testing Kit',
                'category' => 'Health & Personal Care',
                'price' => 4008.78,
                'description' => 'Discover our all-inclusive Blood Glucose Testing Kit, engineered to help you effectively monitor and manage diabetes with ease. This kit includes everything you need for accurate and reliable blood glucose testing at home.',
                'images' => [
                    'images/glucoseTestingStarterPack/On Class Plus II Blood Glucose Testing Kit.jpg'
                ]
            ],
            [
                'name' => 'VivoChek Ino X Blood Glucose Testing Kit',
                'category' => 'Health & Personal Care',
                'price' => 4556.76,
                'description' => 'Experience hassle-free diabetes management with our User-Friendly Blood Glucose Testing Kit. Designed for precision and convenience, this kit provides fast and accurate readings to help you keep your blood sugar levels in check.',
                'images' => [
                    'images/glucoseTestingStarterPack/VivoChek Ino X Blood Glucose Testing Kit.jpg'
                ]
            ],
            [
                'name' => 'SinoCare Blood Glucose Testing Kit',
                'category' => 'Health & Personal Care',
                'price' => 4500.00,
                'description' => 'Achieve quick and precise blood glucose readings with our Testing Kit. Designed for ease of use, this kit ensures you can manage your diabetes with reliable data at your fingertips.',
                'images' => [
                    'images/glucoseTestingStarterPack/SinoCare Blood Glucose Testing Kit.jpg'
                ]
            ],
            [
                'name' => 'One Touch Blood Glucose Meter',
                'category' => 'Health & Personal Care',
                'price' => 3999.00,
                'description' => 'Easy-to-use, portable Glucometer for accurate and fast glucose testing. Ideal for everyday use.',
                'images' => [
                    'images/glucometer/One Touch Blood Glucose Meter.jpg'
                ]
            ],
            [
                'name' => 'Dr. Morthcn Blood Glucose Meter',
                'category' => 'Health & Personal Care',
                'price' => 2450.00,
                'description' => 'Experience the convenience of our portable Glucometer, designed for quick and accurate glucose testing. Perfect for daily monitoring.',
                'images' => [
                    'images/glucometer/Dr. Morthcn Blood Glucose Meter.jpg'
                ]
            ],
            [
                'name' => 'Freestyle Lite Blood Glucose Meter',
                'category' => 'Health & Personal Care',
                'price' => 2876.00,
                'description' => 'Get accurate and fast glucose results with our portable Glucometer. Easy-to-use and perfect for monitoring your levels on the go.',
                'images' => [
                    'images/glucometer/Freestyle Lite Blood Glucose Meter.jpg'
                ]
            ],
            [
                'name' => 'Infinity Foods Organic Soya Beans',
                'category' => 'Food & Beverages',
                'price' => 90.00,
                'description' => 'Indulge in the pure nutritional goodness of our premium soya beans! Rich in protein, fiber, and essential nutrients, our handpicked soya beans are the ideal addition to your healthy lifestyle. Taste the difference and elevate your meals with the natural goodness of soya beans – a nourishing choice for a vibrant, balanced diet.',
                'images' => [
                    'images/soyabeans/Infinity Foods Organic Soya Beans.jpg'
                ]
            ],
            [
                'name' => 'Busy Beans Organic Soya Beans',
                'category' => 'Food & Beverages',
                'price' => 200.00,
                'description' => 'Discover the wholesome goodness of our premium soya beans! Rich in protein, fiber, and essential nutrients, these handpicked soya beans are an ideal addition to a healthy lifestyle. Elevate your meals and experience the nourishing benefits of soya beans – the perfect choice for a vibrant, balanced diet.',
                'images' => [
                    'images/soyabeans/Busy Beans Organic Soya Beans.jpg'
                ]
            ],
            [
                'name' => 'True Organic Soya Beans',
                'category' => 'Food & Beverages',
                'price' => 95.00,
                'description' => 'Experience the nutrient-packed goodness of our premium soya beans! Handpicked for quality, these beans are loaded with protein, fiber, and essential nutrients, making them the perfect addition to your healthy lifestyle. Elevate your meals with the natural goodness of soya beans and enjoy a vibrant, balanced diet.',
                'images' => [
                    'images/soyabeans/True Organic Soya Beans.jpg'
                ]
            ],
            [
                'name' => 'Contour next Blood Glucose Test Strips',
                'category' => 'Health & Personal Care',
                'price' => 100.00,
                'description' => 'Monitor your glucose levels effortlessly with our pack of 50 Glucose Test Strips. Designed for fast, accurate, and simple testing, ideal for daily use.',
                'images' => [
                    'images/glucoseTestStrips/Contour next Blood Glucose Test Strips.jpg'
                ]
            ],
            [
                'name' => 'Prodigy Blood Glucose Test Strips',
                'category' => 'Health & Personal Care',
                'price' => 1200.00,
                'description' => 'Experience precision with our pack of 50 Glucose Test Strips. Quick, accurate, and easy to use for effective glucose level monitoring.',
                'images' => [
                    'images/glucoseTestStrips/Prodigy Blood Glucose Test Strips.jpg'
                ]
            ],
            [
                'name' => 'CareTouch Blood Glucose Test Strips',
                'category' => 'Health & Personal Care',
                'price' => 1050.00,
                'description' => 'Get reliable results with our pack of 50 Glucose Test Strips. Designed for quick, accurate, and easy glucose level monitoring, perfect for everyday use.',
                'images' => [
                    'images/glucoseTestStrips/CareTouch Blood Glucose Test Strips.jpg'
                ]
            ],
            [
                'name' => 'Terrasoul Pumpkin Seeds',
                'category' => 'Food & Beverages',
                'price' => 700.00,
                'description' => 'Experience the satisfying crunch of our roasted pumpkin seeds. Packed with essential nutrients and gently toasted for a rich, nutty flavor, they’re the ideal nutritious snack for any time of day.',
                'images' => [
                    'images/pumpkinSeeds/Terrasoul Pumpkin Seeds.jpg'
                ]
            ]
        ];

        foreach ($products as $productData) {
            $images = $productData['images'];
            unset($productData['images']);

            $product = Product::create($productData);

            foreach ($images as $imagePath) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }
    }
}