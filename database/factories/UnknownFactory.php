<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UnknownFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => substr($this->faker->sentence(), 0, -1) . '?',
        ];
    }
}
