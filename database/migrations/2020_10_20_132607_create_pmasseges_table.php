<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmassegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmasseges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id')->unsigned();
            $table->foreign('pro_id')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');
            $table->text('masg');
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
        Schema::dropIfExists('pmasseges');
    }
}
