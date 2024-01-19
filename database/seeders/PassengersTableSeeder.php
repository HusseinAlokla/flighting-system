<?php

namespace Database\Seeders;

use App\Models\passenger;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PassengersTableSeeder extends Seeder
{

    public function run(): void
    {
        passenger::factory(100)->create();
    }
}
