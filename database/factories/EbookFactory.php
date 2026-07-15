<?php

namespace Database\Factories;

use App\Models\Ebook;
use Illuminate\Database\Eloquent\Factories\Factory;

class EbookFactory extends Factory
{
    protected $model = Ebook::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->unique()->slug(),
            'short_description' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'price' => 19.99,
            'currency' => 'USD',
            'is_published' => true,
            'max_downloads' => 3,
        ];
    }
}
