<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->smallInteger('piority');
            $table->string('image');
            $table->string('color');
            $table->timestamps();

            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sup_categories');
    }
}
