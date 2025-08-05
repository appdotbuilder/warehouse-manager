<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WarehouseLocation>
 */
class WarehouseLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $section = $this->faker->randomElement(['A', 'B', 'C', 'D']);
        $rack = $this->faker->numberBetween(1, 10);
        $row = $this->faker->numberBetween(1, 5);
        
        return [
            'code' => "{$section}{$rack}-R{$row}",
            'name' => "Rak {$section}{$rack}, Row {$row}",
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}