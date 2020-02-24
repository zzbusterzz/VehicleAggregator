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
            $table->bigIncrements('booking_id');
            $table->integer('service_id');
            $table->integer('vehiclebrand_id');
            $table->integer('location_id');
            $table->integer('customer_id');
            $table->integer('serviceprovider_id');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->string('vehicleno');
            $table->smallInteger('yearofmfc');
            $table->string('status');
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
