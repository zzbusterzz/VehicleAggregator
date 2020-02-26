<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',128);
            $table->string('firstname',128); //varchar(255)
            $table->string('lastname',128);
            $table->string('password',64);
            $table->integer('phone');
            $table->string('email');
            $table->bigInteger('partid');
            $table->integer('partquantity');
            $table->integer('partprice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
