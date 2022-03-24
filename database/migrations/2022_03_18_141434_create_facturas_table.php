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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subPedido_id');
            $table->string('num_factura');
            $table->string('nota')->nullable();
            $table->date('fecha')->nullable();
            $table->float('importe')->nullable();
            $table->string('archivo')->nullable();
            $table->timestamps();
            $table->foreign('subPedido_id')->references('id')->on('sub_pedidos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
};
