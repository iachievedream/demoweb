<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

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
            'type' => '1',
            'name' => $this->faker->unique()->name(),
            'content' => $this->faker->unique()->text(16),
            'original_price' => 250,
            'selling_price' => 150,
            'user_id' => 1,
            'times' => 1,
            'time_limit' => 150,
        ];
    }
}
