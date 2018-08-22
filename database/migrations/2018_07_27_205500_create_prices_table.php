<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');

            // fk location
            $table->unsignedInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');            

            // fk item
            $table->unsignedInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');            
            
            // fk user
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // price
            $table->float('value');

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
        Schema::dropIfExists('prices');
    }
}
