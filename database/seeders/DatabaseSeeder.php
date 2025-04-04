<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RegionSeeder::class,
            SubregionSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            ProfileSeeder::class,
            GenerativeModelSeeder::class,
            ImageSeeder::class,
        ]);
    }
}
