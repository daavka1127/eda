<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalSaltDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srvy_local_salt_deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('provID');
            $table->integer('symID');
            $table->string('dpstName');
            $table->string('dpstReserve');
            $table->string('dpstState');
            $table->integer('distance');
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
        Schema::dropIfExists('local_salt_deposits');
    }
}
