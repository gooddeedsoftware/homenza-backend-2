<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('landmark');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->integer('pincode');
            $table->longText('description')->nullable();
            $table->string('gender')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('payment_remark')->nullable();
            $table->float('latitude', 15, 2)->nullable();
            $table->float('longitude', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('youtube_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
