<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SourceLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('source_links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('source_link_id');
            $table->integer('source_id');
            $table->string('source_link');
            $table->string('source_title')->nullable();
            $table->dateTime('source_date')->nullable();
            $table->longText('source_raw')->nullable();
            $table->timestamps();
            $table->tinyInteger('active')->default(0);
            $table->unique(['source_id', 'source_link']);
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
        Schema::dropIfExists('source_links');        
    }
}
