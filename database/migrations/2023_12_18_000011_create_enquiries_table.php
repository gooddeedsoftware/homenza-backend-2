<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('mobile');
            $table->string('enquiry_type');
            $table->boolean('whatsapp_update')->default(0)->nullable();
            $table->boolean('privacy')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
