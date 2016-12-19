<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts',function( Blueprint $table){
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('product_quantity');
            $table->integer('user_id');
            $table->integer('order_id')->nullable();
            $table->enum('status',array('removed_from_cart','order_placed','in_cart'))->default('in_cart');
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
        Schema::drop('carts');
    }
}
