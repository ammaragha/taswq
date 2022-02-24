<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start');
            $table->date('arrival');
            $table->enum('status',['ordered','shipped','delivered','refunded']);
            $table->double('discount')->nullable();
            $table->double('total_price');
            $table->timestamps();

            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('cart_id');

            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('cart_id')->references('id')->on('carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
