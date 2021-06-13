<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => \App\Models\Category::all()->random(1)->first()->id,
            'slug' => $this->faker->slug(),
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => rand(0, 1),
            'price' => rand(10, 1000),
        ];
    }
}
