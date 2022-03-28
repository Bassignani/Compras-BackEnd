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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('cuit',100)->nullable()->unique();
            $table->string('razon_social',255)->nullable();
            $table->string('direccion',255)->nullable();
            $table->string('telefono1',100)->nullable();
            $table->string('telefono2',100)->nullable();
            $table->string('codigo',255)->nullable();
            $table->string('path_img',255)->nullable();
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
        Schema::dropIfExists('empresas');
    }
};
