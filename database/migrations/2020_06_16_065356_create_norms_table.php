<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_norms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('producID');
            $table->integer('normQntt');
            $table->double('normCkal');
            $table->string('normName');
            $table->integer('normID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('norms');
    }
}
