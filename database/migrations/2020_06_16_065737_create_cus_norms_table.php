<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCusNormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cus_norms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('producID');
            $table->integer('cusNormQntt');
            $table->double('cusNormCkal');
            $table->string('cusNormName');
            $table->integer('cusNormID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cus_norms');
    }
}
