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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',120)->comment('Name of the product');
            $table->boolean('is_active')->default(true)->comment('Product is active');
            $table->string('description',255)->nullable()->comment('Description of the product');
            $table->float('price', 15, 2)->nullable()->comment('Price of the product');
            $table->foreignId('category_product_id')->constrained('category_products')->comment('Category of the product');
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
        Schema::dropIfExists('products');
    }
};
