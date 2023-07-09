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
        Schema::create('new_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('bus_id');
            $table->integer('number_of_seats');
            $table->double('total_amount');
            $table->double('payment_amount');
            $table->string('payment_by');
            $table->boolean('status')->default(false);
            $table->foreign('user_id')->references('id')->on('new_users');
            $table->foreign('bus_id')->references('id')->on('new_buses')->onDelete('cascade');
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
        Schema::dropIfExists('new_bookings');
    }
};
