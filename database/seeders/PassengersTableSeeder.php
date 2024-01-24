<?php

namespace Database\Seeders;


use App\Models\Passenger;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PassengersTableSeeder extends Seeder
{

    public function run(): void
    {
        Passenger::factory(900)->create();
    }
}
