<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeathersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weathers', function (Blueprint $table) {
            $table->bigIncrements('weather_id');
            $table->string('api_id');
            $table->string('main');
            $table->string('description');
            $table->integer('temp');
            $table->integer('temp_min');
            $table->integer('temp_max');
            $table->integer('wind_speed');
            $table->integer('cloudiness');
            $table->integer('snow');
            $table->integer('rain');
            $table->datetime('weather_time')->nullable();
            $table->smallInteger('city_id');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weathers');
    }
}
