<?php
// database/factories/PassengerFactory.php

namespace Database\Factories;

use App\Models\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class PassengerFactory extends Factory
{


    public function definition()
    {
        return [
            'FirstName' => $this->faker->firstName,
            'LastName' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password123'), // Hash the password
            'DOB' => $this->faker->date,
            'passport_expiry_date' => $this->faker->date,
            'flight_id' => $this->faker->numberBetween(1, 50)
        ];
    }
}
