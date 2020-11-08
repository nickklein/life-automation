<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTableShoppingCategoriesUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_categories_user', function (Blueprint $table) {
            $table->mediumIncrements('sh_categories_user_id');
            $table->mediumInteger('sh_category_id');
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
        Schema::dropIfExists('shopping_categories_user');
    }
}
