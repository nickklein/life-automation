<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsSummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('news_summary', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('summary_id');
            $table->integer('source_link_id');
            $table->integer('user_id');
            $table->integer('tag_id');            
            $table->tinyInteger('points');
            $table->unique(['source_link_id', 'user_id', 'tag_id']);            
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
        Schema::dropIfExists('news_summary');        
    }
}
