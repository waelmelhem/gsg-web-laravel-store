<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            "category_id"=>Category::inRandomOrder()->limit(1)->first()->id,
            "name"=>$this->faker->productName,
            "description"=>$this->faker->sentence(3,true),
            "image"=>$this->faker->imageUrl(),
            "price"=>$this->faker->randomFloat(2,0,999),
            'compare_price'=>$this->faker->randomFloat(2,1000,3000),
            'quantity'=>$this->faker->randomDigitNotNull(),
            'SKU'=>uniqid()
        ];
    }
}
