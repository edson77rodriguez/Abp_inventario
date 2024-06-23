<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $fillable = ['producto_id', 'cantidad_stock','precio_venta','fecha_ingreso'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

}
