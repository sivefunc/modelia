<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected ?int $cities;
    public function definition(): array
    {

        if (($this->cities ?? false) == false) {
            $this->cities = count(\App\Models\City::all());
        }

        while (is_null($city = \App\Models\City::find(rand(1, $this->cities))));
        $state = $city->state;
        $country = $state->country;
        $subregion = $country->subregion;
        $region = $subregion->region;
        return [
            'user_id' => \App\Models\User::factory(),
            'city_id' => $city->id,
            'state_id' => $state->id,
            'country_id' => $country->id,
            'subregion_id' => $subregion->id,
            'region_id' => $region->id,
            'balance' => rand(100, 1000),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'date_of_birth' => fake()->date()
        ];
    }
}
