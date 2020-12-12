<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCattleQnttsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cattle_qntt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('provID');
            $table->integer('symID');
            $table->integer('malID');
            $table->integer('cattQntt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cattle_qntts');
    }
}
