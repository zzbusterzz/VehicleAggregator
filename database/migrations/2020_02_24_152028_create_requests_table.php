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
            $table->bigIncrements('service_id');
            $table->bigIncrements('vehiclebrand_id');
            $table->bigIncrements('location_id');
            $table->bigIncrements('customer_id');
            $table->bigIncrements('serviceprovider_id');
            $table->date('appointment_date');
            $table->string('appointment_time');
            $table->date('booking_date');
            $table->string('booking_time');
            $table->string('vehicleno');
            $table->intval('yearofmfc');
            $table->string('status');
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
        Schema::dropIfExists('requests');
    }
}
