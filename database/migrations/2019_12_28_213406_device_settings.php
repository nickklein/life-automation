<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeviceSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('device_settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';    
            $table->bigIncrements('device_settings_id');
            $table->string('key', 500);
            $table->string('value', 500);
            $table->mediumInteger('device_id')->nullable()->unsigned();
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
        Schema::dropIfExists('device_settings');
    }
}
