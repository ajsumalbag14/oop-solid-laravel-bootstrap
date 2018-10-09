<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTripQueueDriver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_queue_driver', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_queue_id')->nullable(); 
            $table->integer('driver_id')->default(0)->nullable(); // user_id with user_type_id 2
            /**
             * 1 = PENDING
             * 2 = ON QUEUE
             * 3 = ACCEPTED
             * 4 = REJECTED
             */
            $table->tinyInteger('status_id')->default(1)->nullable();
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
        Schema::dropIfExists('trip_queue_driver');
    }
}
