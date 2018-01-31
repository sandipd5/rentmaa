<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_features', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('property_id')->unsigned()->index();
         $table->foreign('property_id')->references('id')->on('properties');
         $table->integer('feature_id')->unsigned()->index();
         $table->foreign('feature_id')->references('id')->on('features');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties_features');
    }
}
