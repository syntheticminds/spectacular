<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'estimate' => $this->faker->numberBetween(1, 8) / 4,
            'is_complete' => $this->faker->boolean(),
        ];
    }
}
