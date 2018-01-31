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
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('type')->nullable();
            $table->integer('rent');
            $table->integer('shared')->unsigned();
            $table->integer('viewed')->unsigned();
            $table->integer('featured')->nullable();
            $table->tinyInteger('accepted')->nullable();
            $table->integer('user_id')->nullable();  
            $table->string('address')->nullable();
            $table->decimal('gpslat',10,8)->nullable();
            $table->decimal('gpslng', 11, 8)->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('livingrooms')->nullable();
            $table->float('squaremeter')->nullable();
            $table->text('description')->nullable();
            $table->string('features')->nullable();
            $table->integer('status')->nullable();
            $table->longText('tags')->nullable();
            $table->string('ownername')->nullable();
            $table->string('telephone')->nullable();
           $table->integer('area_id')->unsigned()->nullable();
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
