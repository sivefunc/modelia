<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $file_path = resource_path('sql/states.sql');
        \DB::unprepared(
            file_get_contents($file_path)
        );
    }
}
