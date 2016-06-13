<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductsToSite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('price');
            $table->string('delivery');
            $table->string('live')->default('N');
            $table->string('hidden')->default('Y');
            $table->string('sitemap')->default('N');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('categories', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('parent_id');
            $table->string('live')->default('N');
            $table->string('hidden')->default('Y');
            $table->string('sitemap')->default('N');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_product', function (Blueprint $table){
            $table->string('category_id');
            $table->string('product_id');
        });

        Schema::create('category_image', function (Blueprint $table){
            $table->string('category_id');
            $table->string('image_id');
        });

        Schema::create('image_product', function (Blueprint $table){
            $table->string('image_id');
            $table->string('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
        Schema::drop('image_product');
        Schema::drop('category_image');
        Schema::drop('categories');
        Schema::drop('category_product');
    }
}
