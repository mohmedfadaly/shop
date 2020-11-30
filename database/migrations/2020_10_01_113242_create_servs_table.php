<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('osalary');
            $table->integer('salary');
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
        Schema::dropIfExists('servs');
    }
}
