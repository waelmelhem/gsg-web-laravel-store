<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'user_name'=>$this->faker->userName(),
            'email'=>$this->faker->safeEmail(),
            'password'=>Hash::Make('password')
        ];
    }
}
