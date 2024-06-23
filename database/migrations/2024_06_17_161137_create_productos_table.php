<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('talla_id');
            $table->unsignedBigInteger('genero_id');
            $table->unsignedBigInteger('modelo_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('composicion_id');
            $table->unsignedBigInteger('estilo_id');
            $table->float('precio_compra');
            $table->unsignedBigInteger('proveedor_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
