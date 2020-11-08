<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTableShoppingItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_items', function (Blueprint $table) {
            $table->mediumIncrements('sh_item_id');
            $table->string('name', 255);
            $table->string('url', 255);
            $table->tinyInteger('store_id');
            $table->tinyInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_items');
    }
}
