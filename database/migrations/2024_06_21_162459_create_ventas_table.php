<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{   
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_venta');
            $table->unsignedBigInteger('empleado_id');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad');
            $table->foreignId('inventario_id')->constrained('inventarios')->onDelete('cascade');
            $table->float('ganancia');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
