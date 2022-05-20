<?php

namespace Database\Factories;

use App\Models\EventsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventsCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventsCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_name' => $this->faker->text(strtoupper($this->faker->numberBetween(16, 21))),
            'category_description' => $this->faker->text($this->faker->numberBetween(50, 150)),
            'category_order' => $this->faker->randomDigit(),
        ];
    }
}
