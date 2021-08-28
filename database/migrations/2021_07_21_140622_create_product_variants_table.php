<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('variant_type1');
            $table->integer('variant_value1');
            $table->string('variant_type2');
            $table->integer('variant_value2');
            $table->integer('qty');
            $table->boolean('status')->default(false);
            $table->json('image_url')->nullable();
            $table->decimal('price')->default(0);
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
        Schema::dropIfExists('product_variants');
    }
}
