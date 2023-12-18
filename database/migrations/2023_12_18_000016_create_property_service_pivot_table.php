<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('property_service', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id', 'property_id_fk_9313104')->references('id')->on('properties')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_9313104')->references('id')->on('services')->onDelete('cascade');
        });
    }
}
