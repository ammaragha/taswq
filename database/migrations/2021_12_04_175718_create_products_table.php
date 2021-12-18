<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('availability')->default(1);
            $table->integer('quantities');
            $table->integer('sold_times')->nullable();
            $table->double('discount')->nullable();
            $table->double('rating')->nullable();
            $table->string('weight')->nullable();
            $table->string('color')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('subcat_id');
            $table->unsignedBigInteger('brand_id');

            $table->foreign('subcat_id')->references('id')->on('sub_categories');
            $table->foreign('brand_id')->references('id')->on('brands');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
