<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrackingType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('trackings', function (Blueprint $table){
            $table->string('type_id');
        });

        Schema::table('leads', function (Blueprint $table){
            $table->string('type_id');
        });

        Schema::create('tracking_types', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description');
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
        Schema::table('trackings', function (Blueprint $table){
            $table->dropColumn('type_id');
        });
        Schema::table('leads', function (Blueprint $table){
            $table->dropColumn('type_id');
        });

        Schema::drop('tracking_types');
    }
}
