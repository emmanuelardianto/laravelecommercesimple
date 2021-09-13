<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('product_variant_id');
            $table->string('nick_name', 250)->nullable();
            $table->string('title', 250)->nullable();
            $table->string('description', 1000)->nullable();
            $table->tinyInteger('comfort_rating');
            $table->tinyInteger('rating');
            $table->string('gender')->nullable();
            $table->string('size')->nullable();
            $table->string('height_range')->nullable();
            $table->string('weight_range')->nullable();
            $table->string('shoe_size')->nullable();
            $table->string('age_range')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('product_reviews');
    }
}
