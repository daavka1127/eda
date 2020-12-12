<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_food_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('productName');
            $table->double('foodQntt');
            $table->double('foodProtein')->nullable();
            $table->double('foodFat')->nullable();
            $table->double('foodCarbon')->nullable();
            $table->double('foodCkal')->nullable();
            $table->double('foodTomCkal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_products');
    }
}
