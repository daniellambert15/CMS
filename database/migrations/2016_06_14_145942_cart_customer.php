<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CartCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');
            $table->string('surname');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('delivery_addresses', function (Blueprint $table){
            $table->increments('id');
            $table->string('customer_id');
            $table->string('addressLine1');
            $table->string('addressLine2');
            $table->string('town');
            $table->string('county');
            $table->string('postcode');
            $table->string('firstName');
            $table->string('surname');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('delivery', function (Blueprint $table){
            $table->increments('id');
            $table->string('addressLine1');
            $table->string('addressLine2');
            $table->string('town');
            $table->string('county');
            $table->string('postcode');
            $table->string('firstName');
            $table->string('surname');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('carts', function (Blueprint $table){
            $table->string('id');
            $table->string('customer_id')->nullable();
            $table->string('tracking_id');
            $table->string('delivery_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('processed')->default('N');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cart_product', function (Blueprint $table){
            $table->string('cart_id');
            $table->string('product_id');
            $table->string('price');
            $table->string('delivery');
            $table->string('quantity');
            $table->softDeletes();
        });

        Schema::create('invoices', function (Blueprint $table){
            $table->string('cart_id');
            $table->string('customer_id')->nullable();
            $table->string('status_id');
            $table->string('payment_id');
            $table->string('location');
            $table->timestamps();
        });

        Schema::create('statuses', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table){
            $table->string('invoice_id');
            $table->string('payment_id');
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
        Schema::drop('cart_product');
        Schema::drop('carts');
        Schema::drop('customers');
        Schema::drop('delivery');
        Schema::drop('delivery_addresses');
        Schema::drop('invoices');
        Schema::drop('payments');
        Schema::drop('statuses');
    }
}
