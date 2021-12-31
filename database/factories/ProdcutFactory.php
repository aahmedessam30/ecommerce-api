<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdcutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'            => $this->faker->name(),
            'price'           => $this->faker->numberBetween(20, 1000),
            'description'     => $this->faker->sentence(4),
            'image'           => $this->faker->imageUrl('prodcuts'),
            'sub_category_id' => SubCategory::all()->random(),
        ];
    }
}
