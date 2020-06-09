<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provides', function (Blueprint $table) {
            $table->integer('bill_no');
            $table->integer('cutomertype');//cus,
            $table->integer('customer_id');
            $table->date('booking_date');
            $table->time('booking_time');            
            $table->string('status');//ordered,onhold,complete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provides');
    }
}
