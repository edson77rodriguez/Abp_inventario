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
            $table->softDeletes();
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('talla_id');
            $table->unsignedBigInteger('genero_id');
            $table->unsignedBigInteger('modelo_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('composicion_id');
            $table->unsignedBigInteger('estilo_id');
            $table->decimal('precio_compra', 8, 2); // Cambiado a decimal para mayor precisión
            $table->unsignedBigInteger('proveedor_id');

            // New column for image path
            $table->string('imagen')->nullable();

            $table->timestamps();

            // Definir claves foráneas
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('talla_id')->references('id')->on('tallas')->onDelete('cascade');
            $table->foreign('genero_id')->references('id')->on('generos')->onDelete('cascade');
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('composicion_id')->references('id')->on('composicions')->onDelete('cascade');
            $table->foreign('estilo_id')->references('id')->on('estilos')->onDelete('cascade');
            $table->foreign('proveedor_id')->references('id')->on('proveedors')->onDelete('cascade');
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