<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\GenerativeModel;

class GenerativeModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        GenerativeModel::factory()->create([
            'name' => 'Stable Image Ultra', 'cost' => 8.0, 'endpoint' => 'https://api.stability.ai/v2beta/stable-image/generate/ultra']);
        GenerativeModel::factory()->create([
            'name' => 'Stable Image Core', 'cost' => 3.0, 'endpoint' => 'https://api.stability.ai/v2beta/stable-image/generate/core']);
    }
}
