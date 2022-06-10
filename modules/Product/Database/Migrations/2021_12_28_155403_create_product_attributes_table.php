<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('attribute_id')->unsigned()->nullable();
            $table->bigInteger('value_id')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('product_attributes', function (Blueprint $table)
        {
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('value_id')->references('id')->on('attribute_values')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
