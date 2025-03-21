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
            'name' => 'Stable Image Ultra', 'cost' => 9.99]);
        GenerativeModel::factory()->create([
            'name' => 'Stable Image Core', 'cost' => 7.95]);
        GenerativeModel::factory()->create([
            'name' => 'Stable Diffusion 3.5 Large Turbo', 'cost' => 7.25]);
        GenerativeModel::factory()->create([
            'name' => 'Stable Diffusion 3.5 Large', 'cost' => 6.99]);
        GenerativeModel::factory()->create([
            'name' => 'Stable Diffusion 3.5 Medium', 'cost' => 5.99]);
        GenerativeModel::factory()->create([
            'name' => 'SDXL 1.0', 'cost' => 3.99]);
        GenerativeModel::factory()->create([
            'name' => 'SD 1.6', 'cost' => 2.99]);
    }
}
