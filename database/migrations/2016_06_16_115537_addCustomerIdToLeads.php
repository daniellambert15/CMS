<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerIdToLeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table){
           $table->string('customer_id')->nullable();
        });
        Schema::table('customers', function (Blueprint $table){
            $table->string('tracking_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table){
            $table->dropColumn('customer_id');
        });
        Schema::table('customers', function (Blueprint $table){
            $table->dropColumn('tracking_id');
        });
    }
}
