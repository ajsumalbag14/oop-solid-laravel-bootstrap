<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDriver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('plate_number');
            $table->string('car_make');
            $table->string('car_model');
            /**
             * 1 = UNAVAILABLE
             * 2 = AVAILABLE
             * 3 = ONQUEUE
             * 4 = ONTRIP
             */
            $table->tinyInteger('status_id')->default(1); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver');
    }
}
