<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableForContactAndTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // first we need a table for the contact users.

        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');
            $table->string('surname');
            $table->string('fullName');
            $table->string('email');
            $table->string('mobile');
            $table->string('landline');
            $table->string('addressLine1');
            $table->string('addressLine2');
            $table->string('addressLine3');
            $table->string('town');
            $table->string('county');
            $table->string('postcode');
            $table->string('serviceRequired');
            $table->string('area');
            $table->string('trackingId');
            $table->string('pageId');
            $table->string('leadNotes');
            $table->string('affiliateId');
            $table->string('campaignId');
            $table->string('forwardedId')->nullable();
            $table->string('managerNotes');
            $table->string('ecisJobNumber');
            $table->string('jobPrice');
            $table->string('sentToEcis');
            $table->string('ecisTelephoneResponceTime');
            $table->string('ecisEmailResponceTime');
            $table->string('ecisJobCreationResponceTime');
            $table->string('ecisJobCancelReason');
            $table->timestamps();
            $table->softDeletes();
        });

        // now we need a table for the tracking

        Schema::create('trackings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trackingId');
            $table->string('pageId');
            $table->string('moveMouse');
            $table->string('isBot');
            $table->string('IP');
            $table->string('browser');
            $table->string('referer');
            $table->string('town');
            $table->string('county');
            $table->string('checked');
            $table->string('visitedBefore');
            $table->string('forwardId');
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
        Schema::drop('leads');
        Schema::drop('tracking');
    }
}
