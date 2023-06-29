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
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->float('price', 12, 2)->comment('Pirce to service');
            $table->float('percentage', 2, 2)->comment('Porcentage to tax IVA');
            $table->integer('quantity')->comment('Quantity to service invoice');
            $table->foreignId('invoice_id')->constrained('invoices')->comment('Relation with invoices table');
            $table->foreignId('service_id')->constrained('services')->comment('Relation with services table');
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
        Schema::dropIfExists('invoice_lines');
    }
};
