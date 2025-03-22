<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ImageFactory extends Factory
{
    protected ?int $models;
    protected ?int $profiles;
    public function definition(): array
    {

        if (($this->models ?? false) == false) {
            $this->models = count(\App\Models\GenerativeModel::all());
        }

        $model = \App\Models\GenerativeModel::find(rand(1, $this->models));
        if (($this->profiles ?? false) == false) {
            $this->profiles = count(\App\Models\GenerativeModel::all());
        }

        $profile = \App\Models\GenerativeModel::find(rand(1, $this->profiles));
        $width = rand(320, 640);
        $height = rand(320, 640);
        $size = $width * $height;
        $timestamp = rand(
            now()->startOfYear()->timestamp, now()->endOfYear()->timestamp
        );
        return [
            'generative_model_id' => $model->id,
            'profile_id' => $profile->id,
            'link' => Str::random(20),
            'prompt' => fake()->text(),
            'attachment' => '...',
            'type' => Str::random(10),
            'photo_size' => $size,
            'resolution' => "{$width}{$height}",
            'created_at' => date("Y-m-d H:i:s", $timestamp),
            'updated_at' => date("Y-m-d H:i:s", $timestamp),
        ];
    }
}
