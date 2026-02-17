<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RequirementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'blocked_reason' => $this->faker->optional(0.25)->sentence,
            'description' => '<p>' . implode('</p><p>', $this->faker->paragraphs($this->faker->numberBetween(1, 3))) . '</p>',
            'name' => lcfirst($this->faker->sentence()),
            'source' => $this->faker->optional()->sentence(),
            'weight' => null,
        ];
    }
}
