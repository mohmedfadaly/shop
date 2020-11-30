<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqServsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_servs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ser_id')->unsigned();
            $table->foreign('ser_id')->references('id')->on('servs')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('req_id')->unsigned();
            $table->foreign('req_id')->references('id')->on('requests')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('req_servs');
    }
}
