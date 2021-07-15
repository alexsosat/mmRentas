<?php

namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 5),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(255),
            'rooms' => rand(0, 4),
            'bathrooms' => rand(0, 4),
            'address' => $this->faker->address,
            'price' => $this->faker->numberBetween($min = 1500, $max = 4000),
            'isActive' => rand(0, 1)

        ];
    }
}
