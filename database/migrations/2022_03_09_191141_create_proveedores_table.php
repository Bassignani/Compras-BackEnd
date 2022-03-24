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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('cuit',100)->nullable();
            $table->string('direccion',100)->nullable();
            $table->string('telefono1',100)->nullable();
            $table->string('telefono2',100)->nullable();
            $table->string('razon_social',100)->nullable();
            $table->string('provincia',100)->nullable();
            $table->string('localidad',100)->nullable();
            $table->text('comentario')->nullable();
            $table->string('codigo',255)->nullable();
            $table->string('email',255)->nullable();
            $table->unsignedInteger('calificacion')->nullable();
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
        Schema::dropIfExists('proveedores');
    }
};
