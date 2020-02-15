<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add3hrain3hsnowColumnsToWeathersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weathers', function (Blueprint $table) {
            //
            $table->integer('snow3h')->after('snow');
            $table->integer('rain3h')->after('rain');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weathers', function (Blueprint $table) {
            //
            $table->dropColumn('snow3h');
            $table->dropColumn('rain3h');
        });
    }
}
