<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('departure_city');
            $table->string('arrival_city');
            $table->timestamp('departure_time')->default(now());
            $table->timestamp('arrival_time')->default(now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
}

