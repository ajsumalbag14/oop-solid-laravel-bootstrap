<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('passenger_id')->nullable(); // user_id with user_type_id 1
            $table->integer('driver_id')->default(0)->nullable(); // user_id with user_type_id 2
            $table->decimal('rate_amount', 14, 2);
            $table->string('origin_address');
            $table->string('origin_longitude')->nullable();
            $table->string('origin_latitude')->nullable();
            $table->string('destination_address');
            $table->string('destination_longitude')->nullable();
            $table->string('destination_latitude')->nullable();
            $table->string('current_longitude')->nullable();
            $table->string('current_latitude')->nullable();
            $table->string('estimated_distance');
            $table->string('estimated_time');
            /**
             * 1 = FOR PICK UP
             * 2 = IN TRANSIT
             * 3 = ARRIVED/COMPLETED
             * 4 = CANCELLED BY PASSENGER
             * 5 = CANCELLED BY DRIVER
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
        Schema::dropIfExists('trip');
    }
}
