<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPropertiesTable extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('property_type_id')->nullable();
            $table->foreign('property_type_id', 'property_type_fk_9313099')->references('id')->on('propert_types');
        });
    }
}
