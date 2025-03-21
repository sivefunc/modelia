<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GenerativeModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'cost' => rand(100, 999) / 100.0
        ];
    }
}
