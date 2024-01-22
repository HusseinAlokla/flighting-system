<?php
// database/factories/FlightFactory.php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        return [
            'number' => $this->faker->unique()->word,
            'departure_city' => $this->faker->city,
            'arrival_city' => $this->faker->city,
            'departure_time' => $this->faker->dateTimeBetween('+1 day', '+10 days'),
            'arrival_time' => $this->faker->dateTimeBetween('+11 days', '+20 days'),
        ];
    }
}
