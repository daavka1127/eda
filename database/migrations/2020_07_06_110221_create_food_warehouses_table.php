<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srvy_food_warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('provID');
            $table->integer('symID');
            $table->string('firmName');
            $table->date('startDate');
            $table->string('capacity');
            $table->string('state');
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
        Schema::dropIfExists('food_warehouses');
    }
}
