<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 1500),
            'user_type' => $this->faker->randomElement(['user', 'page']),
            'in_group' => '0',
            'group_id' => 0,
            'group_approved' => $this->faker->randomElement(['0', '1']),
            'in_event' => '0',
            'event_id' => 0,
            'event_approved' => '0',
            'post_type' => '',/**$this->faker->randomElement(['photo', 'shared', 'video', 'profile_picture', 'article', 'file']),**/
//            'origin_id' => 0,
            'privacy' => 'public',
            'text' => $this->faker->text($this->faker->numberBetween(64, 255)),
        ];
    }
}
