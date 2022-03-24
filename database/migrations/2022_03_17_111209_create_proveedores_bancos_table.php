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
        Schema::create('proveedores_bancos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id');
            $table->string('banco');
            $table->string('num_cuenta')->nullable();
            $table->string('cbu')->nullable();
            $table->string('tipo_cuenta')->nullable();
            $table->string('alias')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores_bancos');
    }
};
