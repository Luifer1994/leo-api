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
        Schema::create('invoice_line_supplies', function (Blueprint $table) {
            $table->id();
            $table->string('description')->comment('Name or description to supply');
            $table->float('price', 12, 2)->comment('Pirce to service');
            $table->float('percentage_tax', 4, 2)->comment('Porcentage to tax IVA');
            $table->integer('quantity')->comment('Quantity to service invoice');
            $table->foreignId('invoice_line_id')->constrained('invoice_lines')->comment('Relation to invoice lines table');
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
        Schema::dropIfExists('invoice_line_supplies');
    }
};
