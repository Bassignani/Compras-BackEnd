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
        Schema::create('sub_pedido_notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subPedido_id');
            $table->text('descripcion');
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
        Schema::dropIfExists('sub_pedido_notas');
    }
};
