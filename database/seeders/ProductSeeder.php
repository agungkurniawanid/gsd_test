<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
        [
            'brand' => 'Bugatti',
            'type' => 'Super Car',
            'stock' => 5,
            'price' => 25000000000,
            'description' => 'Bugatti Chiron with 1500HP quad-turbo W16 engine',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Ferrari',
            'type' => 'Sports Car',
            'stock' => 8,
            'price' => 15000000000,
            'description' => 'Ferrari 488 Pista with 3.9L V8 twin-turbo engine',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Lamborghini',
            'type' => 'Super Car',
            'stock' => 6,
            'price' => 18000000000,
            'description' => 'Lamborghini Aventador SVJ with V12 engine',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Porsche',
            'type' => 'Sports Car',
            'stock' => 12,
            'price' => 12000000000,
            'description' => 'Porsche 911 Turbo S with 3.8L flat-6 twin-turbo',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'McLaren',
            'type' => 'Super Car',
            'stock' => 4,
            'price' => 20000000000,
            'description' => 'McLaren 720S with 4.0L twin-turbo V8',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Aston Martin',
            'type' => 'GT Car',
            'stock' => 7,
            'price' => 9000000000,
            'description' => 'Aston Martin DBS Superleggera with V12 engine',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Rolls Royce',
            'type' => 'Luxury Sedan',
            'stock' => 3,
            'price' => 35000000000,
            'description' => 'Rolls Royce Phantom with ultimate luxury features',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Bentley',
            'type' => 'Luxury SUV',
            'stock' => 9,
            'price' => 12000000000,
            'description' => 'Bentley Bentayga with W12 engine',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Lexus',
            'type' => 'Luxury Sedan',
            'stock' => 15,
            'price' => 8000000000,
            'description' => 'Lexus LS500 with 3.5L twin-turbo V6',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Maserati',
            'type' => 'Sports Sedan',
            'stock' => 6,
            'price' => 11000000000,
            'description' => 'Maserati Quattroporte with Ferrari-built V8',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Jaguar',
            'type' => 'Sports Car',
            'stock' => 8,
            'price' => 9500000000,
            'description' => 'Jaguar F-Type R with supercharged V8',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Land Rover',
            'type' => 'Luxury SUV',
            'stock' => 12,
            'price' => 8500000000,
            'description' => 'Range Rover Autobiography with premium features',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Tesla',
            'type' => 'Electric Car',
            'stock' => 20,
            'price' => 7500000000,
            'description' => 'Tesla Model S Plaid with 1020HP electric motors',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Audi',
            'type' => 'Luxury Sedan',
            'stock' => 18,
            'price' => 7000000000,
            'description' => 'Audi A8 L with 4.0L twin-turbo V8',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'BMW',
            'type' => 'Sports Sedan',
            'stock' => 15,
            'price' => 6500000000,
            'description' => 'BMW M5 Competition with 625HP V8',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Mercedes',
            'type' => 'Luxury Sedan',
            'stock' => 14,
            'price' => 7200000000,
            'description' => 'Mercedes S-Class with latest tech features',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Ford',
            'type' => 'Muscle Car',
            'stock' => 10,
            'price' => 5500000000,
            'description' => 'Ford Mustang Shelby GT500 with supercharged V8',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Chevrolet',
            'type' => 'Sports Car',
            'stock' => 9,
            'price' => 5800000000,
            'description' => 'Chevrolet Corvette Stingray with mid-engine V8',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Dodge',
            'type' => 'Muscle Car',
            'stock' => 7,
            'price' => 5200000000,
            'description' => 'Dodge Challenger Hellcat Redeye with 797HP',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand' => 'Jeep',
            'type' => 'Offroad SUV',
            'stock' => 16,
            'price' => 6000000000,
            'description' => 'Jeep Wrangler Rubicon with 4x4 capabilities',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];

    Product::insert($products);
    }
}
