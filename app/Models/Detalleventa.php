<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleventa extends Model
{
    use HasFactory;

    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'inventario_id', 'tipopago_id'];

    protected $table = 'detalle_ventas'; // Especifica el nombre de la tabla

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function tipopago()
    {
        return $this->belongsTo(Tipopago::class);
    }
}

