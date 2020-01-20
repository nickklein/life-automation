<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Devices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //
        Schema::create('devices', function (Blueprint $table) {
            $table->engine = 'InnoDB';    
            $table->bigIncrements('device_id');
            $table->string('device_name', 500)->nullable();
            $table->smallInteger('user_id')->nullable()->unsigned();
            $table->dateTime('last_sync')->nullable();
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
        //
        Schema::dropIfExists('devices');
    }
}
