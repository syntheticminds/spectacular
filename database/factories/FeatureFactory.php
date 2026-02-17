<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FeatureFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => ucwords($this->faker->bs()),
            'description' => '<p>' . implode('</p><p>', $this->faker->paragraphs($this->faker->numberBetween(1, 3))) . '</p>',
            'weight' => null,
        ];
    }
}
