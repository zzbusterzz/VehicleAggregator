<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_inventory', function (Blueprint $table) {
            $table->integer('vendor_id');
            $table->integer('products_id');
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
        Schema::dropIfExists('vendor_inventory');
    }
}
