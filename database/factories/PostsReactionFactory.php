<?php

namespace Database\Factories;

use App\Models\PostsReaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsReactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostsReaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => $this->faker->numberBetween(1, 6548),
            'user_id' => $this->faker->numberBetween(1, 1500),
            'reaction' => $this->faker->randomElement([
                'reaction_like_count',
                'reaction_love_count',
                'reaction_haha_count',
                'reaction_yay_count',
                'reaction_wow_count',
                'reaction_sad_count',
                'reaction_angry_count',
            ]),
        ];
    }
}
