<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'string' => fake()->text(255),
            'text' => fake()->text(1000),
            'json' => null,
            'boolean' => fake()->boolean(),
            'integer' => rand(1, 10),
            'float' => fake()->randomFloat(2, 1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
