<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrackingClick extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('tracking_clicks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tracking_id');
            $table->string('action'); // click, hover, view
            $table->string('type'); // id, div, span, name
            $table->string('name'); // name="contactName" or id="postcodeInput"
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
        Schema::drop('tracking_clicks');
    }
}
