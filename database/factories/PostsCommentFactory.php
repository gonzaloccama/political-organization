<?php

namespace Database\Factories;

use App\Models\PostsComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostsComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            'node_id' => $this->faker->numberBetween(2490, 5654),
            'node_type' => $this->faker->randomElement(['post', 'photo', 'comment']),
            'user_id' => $this->faker->numberBetween(1, 1500),
            'user_type' => $this->faker->randomElement(['user', 'page']),
            'text' => $this->faker->text($this->faker->numberBetween(20, 200)),
        ];
    }
}
