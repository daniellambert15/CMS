<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');                         // page name
            $table->string('url');                          // url of the page
            $table->string('title');                        // title of the page link, eg title=""
            $table->string('type');                         // schema.org type
            $table->text('content');                        // page content
            $table->integer('contactForm')->default(1);     // page contact form
            $table->string('metaDescription');              // meta description
            $table->string('live', 1)->default('N');        // is the page live?
            $table->string('hidden', 1)->default('Y');      // is the page hidden
            $table->string('page_id')->nullable();          // does the page have a parent
            $table->string('blueBarTitle');                 // blue bar text
            $table->string('affiliate_id')->nullable();     // which affiliate?
            $table->char('sitemap', 1)->default('Y');       // does the page belong on the site map
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
        Schema::drop('pages');
    }
}
