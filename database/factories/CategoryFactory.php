<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arr=explode(" ",$this->faker->words(3,true));


        return [
            'parent_id'=>null,
            'name'=>$this->faker->department,
            'description'=> $this->faker->sentence(1,true),
            'image'=>$this->faker->imageUrl(),


        ];
    }
}
