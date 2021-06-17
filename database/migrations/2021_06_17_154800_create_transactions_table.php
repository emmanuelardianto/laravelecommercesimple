<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 11)->unique();
            $table->integer('user_id')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address', 500)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('payment', 20)->nullable();
            $table->string('status', 20)->default('CART');
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
        Schema::dropIfExists('transactions');
    }
}
