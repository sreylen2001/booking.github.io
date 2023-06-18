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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('bus_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained();
            $table->foreignId('region_id')->constrained();
            $table->foreignId('destination_id')->constrained();
            $table->string('schedule_date');
            $table->string('departure_time');
            $table->string('estimated_arrival_time');
            $table->float('fee', 8, 2);
            $table->longText('remarks');
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
        Schema::dropIfExists('schedules');
    }
};
