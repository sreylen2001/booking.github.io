<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_bus_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_id');
            $table->string('from');
            $table->string('to');
            $table->double('fare_amount');
            $table->dateTime('departure_time');
            $table->time('estimated_arrival_time');
            $table->boolean('status')->default(true);
            $table->foreign('bus_id')->references('id')->on('new_buses');
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
        Schema::dropIfExists('new_bus_tickets');
    }
};
