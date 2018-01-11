<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->string('images');
            $table->integer('category_id')->unsigned()->nullable();
          //   $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('type')->nullable();
            $table->integer('rent');
            $table->integer('shared')->unsigned();
            $table->integer('viewed')->unsigned();
            $table->integer('favoirited')->unsigned()->nullable();
            $table->integer('featured');
            $table->tinyInteger('accepted');
            $table->string('address');
            $table->float('gpslat');
            $table->float('gpslng');
            $table->string('country');
          
            $table->string('zipcode');
          
            $table->integer('bathrooms');
            $table->integer('bedrooms');
            $table->integer('livingrooms');
            $table->float('squaremeter');
            $table->text('description');
            $table->string('features');
            $table->integer('status');
            $table->string('ownername');
            $table->string('telephone');
            $table->integer('city_id')->unsigned()->nullable();
            //$table->foreign('city_id')->references('id')->on('cities');

            $table->string('email')->unique();
          
            $table->timestamp('yearbuilt');
            
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

        
        Schema::dropIfExists('properties'); 
        
    }
}
