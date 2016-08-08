<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixIncrementsOnCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('carts');

        Schema::create('carts', function (Blueprint $table){
            $table->increments('id');
            $table->string('customer_id')->nullable();
            $table->string('tracking_id');
            $table->string('delivery_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('processed')->default('N');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
