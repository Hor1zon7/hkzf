<?php

namespace Database\Factories\Article;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;
/**
// * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model\Article>\
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            "desn"=>$this->faker->text(100),
            "author"=>$this->faker->name,
            'pic'=>'/uploads/article/'.rand(1000,9999).'.jpg',
            'body'=>$this->faker->text
        ];
    }
}
