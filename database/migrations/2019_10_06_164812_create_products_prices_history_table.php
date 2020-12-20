<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsPricesHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_prices_history', function (Blueprint $table) {
            $table->integer('fk_products');
            $table->integer('fk_stores');
            $table->double('price', 10, 2)->nullable();
            $table->double('oldprice', 10, 2)->nullable();
            $table->double('discount', 10, 2)->nullable();
            $table->double('olddiscount', 10, 2)->nullable();
            $table->integer('fk_createdby');
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
        Schema::dropIfExists('products_prices_history');
    }
}
