<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sym', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('provID');
            $table->string('symName');
            $table->integer('normID');
            $table->integer('isCustomizeID');
            $table->integer('isStart');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syms');
    }
}
