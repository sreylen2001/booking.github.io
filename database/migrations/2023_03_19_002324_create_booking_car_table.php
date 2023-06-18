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
        Schema::create('booking_cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained();
            $table->integer('number_of_seats');
            $table->float('fare_amount', 8, 2);
            $table->float('total_amount', 8, 2);
            $table->tinyInteger('booking_status')->default(1)->comment("1=Approved; 0=Cancelled");
            $table->timestamp('create_at')->useCurrent();
            $table->timestamp('update_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_cars');
    }
};
