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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name',120)->comment('Name of the service');
            $table->boolean('is_active')->default(true)->comment('Service is active');
            $table->string('description',255)->nullable()->comment('Description of the service');
            $table->float('price', 15, 2)->nullable()->comment('Price of the service');
            $table->foreignId('category_service_id')->constrained('category_services')->comment('Category of the service');
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
        Schema::dropIfExists('services');
    }
};
