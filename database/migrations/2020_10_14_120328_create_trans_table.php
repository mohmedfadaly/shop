<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('num');
            $table->integer('cash');
            $table->string('bank');
            $table->integer('state')->default(0);
            $table->string('image');
            $table->integer('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('prov_id')->unsigned();
            $table->foreign('prov_id')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('trans');
    }
}
