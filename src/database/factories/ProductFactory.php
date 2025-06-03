<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(100, 10000),
            'image' => $this->faker->imageUrl(300, 200, 'fruits'),
            'description' => $this->faker->sentence(10),
            'season_id' => 1,
        ];
    }
}
