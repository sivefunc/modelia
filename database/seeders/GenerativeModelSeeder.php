<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerativeModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $privileges = array(
            array('name' => 'Stable Image Ultra', 'cost' => 9.99),
            array('name' => 'Stable Image Core', 'cost' => 7.95),
            array('name' => 'Stable Diffusion 3.5 Large Turbo', 'cost' => 7.25),
            array('name' => 'Stable Diffusion 3.5 Large', 'cost' => 6.99),
            array('name' => 'Stable Diffusion 3.5 Medium', 'cost' => 5.99),
            array('name' => 'SDXL 1.0', 'cost' => 3.99),
            array('name' => 'SD 1.6', 'cost' => 2.99),
        );
		DB::table('generative_models')->insert($privileges);
    }
}
