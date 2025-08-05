<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\WarehouseLocation;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and accessories', 'status' => 'active'],
            ['name' => 'Clothing', 'description' => 'Apparel and fashion items', 'status' => 'active'],
            ['name' => 'Home & Garden', 'description' => 'Home improvement and garden supplies', 'status' => 'active'],
            ['name' => 'Sports & Outdoors', 'description' => 'Sports equipment and outdoor gear', 'status' => 'active'],
            ['name' => 'Books', 'description' => 'Books and educational materials', 'status' => 'active'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create warehouse locations
        $locations = [
            ['code' => 'A1-R1', 'name' => 'Rak A1, Row 1', 'description' => 'Main storage area A1', 'status' => 'active'],
            ['code' => 'A1-R2', 'name' => 'Rak A1, Row 2', 'description' => 'Main storage area A1', 'status' => 'active'],
            ['code' => 'A2-R1', 'name' => 'Rak A2, Row 1', 'description' => 'Main storage area A2', 'status' => 'active'],
            ['code' => 'B1-R1', 'name' => 'Rak B1, Row 1', 'description' => 'Secondary storage area B1', 'status' => 'active'],
            ['code' => 'B1-R2', 'name' => 'Rak B1, Row 2', 'description' => 'Secondary storage area B1', 'status' => 'active'],
        ];

        foreach ($locations as $location) {
            WarehouseLocation::create($location);
        }

        // Create suppliers
        Supplier::factory(10)->create();

        // Create customers
        Customer::factory(15)->create();

        // Create products
        $categoryIds = Category::pluck('id')->toArray();
        
        Product::factory(50)->create([
            'category_id' => fake()->randomElement($categoryIds),
        ]);

        // Create some products with low stock (for alerts)
        Product::factory(5)->create([
            'category_id' => fake()->randomElement($categoryIds),
            'stock_quantity' => fake()->numberBetween(0, 10),
            'min_stock_level' => fake()->numberBetween(15, 30),
        ]);

        // Create stock movements
        $productIds = Product::pluck('id')->toArray();
        $locationIds = WarehouseLocation::pluck('id')->toArray();

        StockMovement::factory(100)->create([
            'product_id' => fake()->randomElement($productIds),
            'warehouse_location_id' => fake()->randomElement($locationIds),
        ]);
    }
}