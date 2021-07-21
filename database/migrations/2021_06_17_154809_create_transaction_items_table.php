<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_id');
            $table->integer('product_id');
            $table->integer('product_variant_id');
            $table->string('name', 1000)->nullable();
            $table->double('price')->default(0);
            $table->double('discount')->default(0);
            $table->integer('qty')->default(1);
            $table->double('weight')->default(1);
            $table->double('shipping_cost')->default(1);
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
        Schema::dropIfExists('transaction_items');
    }
}
