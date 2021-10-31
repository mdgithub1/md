<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory to seed database with initial data
 */
class ExpensesFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->text(25),
            'value' => $this->faker->randomFloat(2, 1, 15000),
            'expenses_type_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
