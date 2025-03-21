<?php

namespace Database\Seeders;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Profile::factory()->create([
            'user_id' => 1,
        ]);
        Profile::factory(12)->create();
    }
}
