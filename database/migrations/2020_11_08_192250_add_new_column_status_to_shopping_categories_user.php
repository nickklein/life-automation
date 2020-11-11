<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnStatusToShoppingCategoriesUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // low, priority, disabled, normal
        Schema::table('shopping_categories_user', function (Blueprint $table) {
            $table->tinyInteger('status')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping_categories_user', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
