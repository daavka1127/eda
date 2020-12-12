<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAxaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_axax', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('axaxName');
            $table->integer('levelID')->nullable();
            $table->integer('inTime')->nullable();
            $table->integer('mainOrgID')->nullable();
            $table->integer('supportOrgID')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('axaxes');
    }
}
