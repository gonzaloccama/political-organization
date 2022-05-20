<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_privacy' => $this->faker->randomElement(['secret', 'closed', 'public']),
            'event_admin' => $this->faker->numberBetween(1, 1500),
            'event_category' => $this->faker->numberBetween(1, 10),
            'event_title' => $this->faker->text($this->faker->numberBetween(20, 30)),
            'event_start_date' => $this->faker->dateTimeBetween('2004-06-14 17:43:57', '2020-06-14 17:43:57', 'America/Lima'),
            'event_end_date' => $this->faker->dateTimeBetween('2020-07-14 17:43:57', '2021-10-14 17:43:57', 'America/Lima'),
            'event_location' => $this->faker->city(),
            'event_description' => $this->faker->text($this->faker->numberBetween(50, 300)),
        ];
    }
}
