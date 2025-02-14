<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => "admin",
            'email' => "admin@user.com",
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        // User::factory(10)->create();
        Category::create(['category_name' => "Electronics"]);
        Category::create(['category_name' => "Home Appliances"]);
        Category::create(['category_name' => "Sports"]);
        Category::create(['category_name' => "Books"]);
        $products = [
            ['name' => 'Sport Watch', 'description' => 'Water-resistant sports watch with a sleek and modern design. Equipped with a digital display and date feature.', 'category_id' => 1],
            ['name' => 'Fitness Watch', 'description' => 'Sports watch with water resistance and a digital screen. Modern and simple design.', 'category_id' => 1],
             ['name' => 'Smart Watch', 'description' => 'Smart watch with fitness tracking and water resistance.', 'category_id' => 1],
             ['name' => 'Bluetooth Headphones', 'description' => 'High-quality Bluetooth headphones with noise cancellation and quick connectivity.', 'category_id' => 2],
            ['name' => 'Wireless Headphones', 'description' => 'Wireless headphones with noise cancellation and high-quality sound.', 'category_id' => 2],
             ['name' => 'Sport Headphones', 'description' => 'Sport wireless headphones with sweat resistance and high audio quality.', 'category_id' => 2],
            ['name' => 'Security Camera', 'description' => 'Home security camera with night vision and HD recording.', 'category_id' => 3],
            ['name' => 'Surveillance Camera', 'description' => 'Wireless security camera with night vision and HD quality recording.', 'category_id' => 3],
            ['name' => 'Outdoor Camera', 'description' => 'Outdoor security camera with 1080p HD recording and night vision.', 'category_id' => 3],
            ['name' => 'Desk Fan', 'description' => 'Small desktop fan with three-speed settings and quiet operation.', 'category_id' => 4],
            ['name' => 'Electric Fan', 'description' => 'Portable electric fan with adjustable speed and quiet operation.', 'category_id' => 4],
            ['name' => 'Cooling Fan', 'description' => 'Compact fan with three adjustable speeds for personal cooling.', 'category_id' => 4],
        ];

        // Create products in the database
        foreach ($products as $productData) {
            $product = Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => rand(50, 500), // Random price
                'product_quantity' => rand(5, 20),
                'category_id' => $productData['category_id'],
            ]);

            // Add photo for the product
            $product->photos()->create([
                'photo_name' => 'product_' . $product->id . '.png',
                'photo_path' => 'assets/images/product_' . $product->id . '.png',
                'mime_type' => 'image/png',
            ]);
        }


    }
}
