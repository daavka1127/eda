<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodFactoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srvy_food_factories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('provID');
            $table->integer('symID');
            $table->string('name');
            $table->string('activity');
            $table->string('factoryCapacity');
            $table->string('resName');
            $table->string('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_factories');
    }
}
