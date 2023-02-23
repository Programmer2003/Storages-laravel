<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('TTH');
            $table->integer('count');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->index('product_id', 'products_expenses_idx');
            $table->foreign('product_id', 'products_expenses_fk')->on('products')->references('id');

            $table->index('TTH', 'expenses_products_idx');
            $table->foreign('TTH', 'expenses_products_fk')->on('expenses')->references('TTH');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_expenses');
    }
};
