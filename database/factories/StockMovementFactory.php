<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\WarehouseLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockMovement>
 */
class StockMovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['inbound', 'outbound', 'adjustment']);
        $quantity = $this->faker->numberBetween(1, 100);
        $previousStock = $this->faker->numberBetween(0, 500);
        
        $newStock = match ($type) {
            'inbound' => $previousStock + $quantity,
            'outbound' => max(0, $previousStock - $quantity),
            'adjustment' => $this->faker->numberBetween(0, 500),
            default => $previousStock,
        };
        
        return [
            'product_id' => Product::factory(),
            'warehouse_location_id' => WarehouseLocation::factory(),
            'type' => $type,
            'quantity' => $quantity,
            'previous_stock' => $previousStock,
            'new_stock' => $newStock,
            'reference_type' => $this->faker->randomElement(['purchase_order', 'sales_order', 'adjustment']),
            'reference_id' => $this->faker->numberBetween(1, 100),
            'notes' => $this->faker->sentence(),
            'movement_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}