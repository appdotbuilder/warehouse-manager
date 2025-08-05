<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $purchasePrice = $this->faker->randomFloat(2, 10, 500);
        $sellingPrice = $purchasePrice * $this->faker->randomFloat(2, 1.2, 2.5); // 20-150% markup
        
        return [
            'name' => $this->faker->words(3, true),
            'sku' => strtoupper($this->faker->unique()->bothify('??##??##')),
            'description' => $this->faker->paragraph(),
            'purchase_price' => $purchasePrice,
            'selling_price' => $sellingPrice,
            'stock_quantity' => $this->faker->numberBetween(0, 500),
            'min_stock_level' => $this->faker->numberBetween(5, 50),
            'category_id' => Category::factory(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}