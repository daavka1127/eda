<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_population', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('provID');
            $table->integer('symID');
            $table->bigInteger('totalPop')->nullable();
            $table->bigInteger('standardPop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('populations');
    }
}
