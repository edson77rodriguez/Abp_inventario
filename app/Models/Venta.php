<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['inventario_id','fecha_venta', 'empleado_id','producto_id','ganancia'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
