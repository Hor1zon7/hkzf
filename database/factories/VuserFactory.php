<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article\Vuser>
 */
class VuserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username'=>$this->faker->userName,
            'password'=>bcrypt('123456'),
            'email'=>$this->faker->email,
            'sex'=>['男','女'][rand(0,1)]
        ];
    }
}
