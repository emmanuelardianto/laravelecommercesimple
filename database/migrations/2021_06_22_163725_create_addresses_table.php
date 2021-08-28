<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('first_name_kana', 100);
            $table->string('last_name_kana', 100);
            $table->string('line1', 500);
            $table->string('line2', 500)->nullable();
            $table->string('country', 100);
            $table->string('city', 100);
            $table->string('zip_code', 10);
            $table->string('phone', 15);
            $table->string('mobile_phone', 15);
            $table->boolean('default')->default(false);
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
        Schema::dropIfExists('addresses');
    }
}
