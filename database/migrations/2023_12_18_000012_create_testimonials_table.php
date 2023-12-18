<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('testimonial');
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('pintrest_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
