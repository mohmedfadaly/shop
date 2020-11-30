<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->string('image_i')->nullable();
            $table->integer('sec_id')->unsigned();
            $table->foreign('sec_id')->references('id')->on('sections')->onUpdate('cascade')->onDelete('cascade');
            $table->string('address');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->float('reats')->default(0);
            $table->float('wallet')->default(0);
            $table->longText('fcm_token')->nullable();
            $table->string('password');
            $table->string('api_token', 80)->unique()
            ->nullable()
            ->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('providers');
    }
}
