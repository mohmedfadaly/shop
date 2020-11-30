<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('prov_id')->unsigned();
            $table->foreign('prov_id')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('state');
            $table->time('time_from');
            $table->time('time_to');
            $table->string('address');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->date('date');
            $table->text('des');
            $table->integer('active')->default(0);
            $table->text('why')->nullable();
            $table->integer('Total');
            $table->float('tax');
           
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
        Schema::dropIfExists('requests');
    }
}
