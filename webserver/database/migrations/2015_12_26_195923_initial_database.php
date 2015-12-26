<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialDatabase extends Migration
{
    /**
     * Run the migrations.
     * Create the initial table after our discussion of the 21 dec 2015
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->string('zip');
            $table->string('city');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('sensors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('unit');
            $table->string('sensor_type');
            $table->timestamps();
        });

        Schema::create('samplings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations');

            $table->integer('sensor_id')->unsigned();
            $table->foreign('sensor_id')->references('id')->on('sensors');

            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('locations');
        Schema::drop('sensors');
        Schema::drop('samplings');
    }
}
