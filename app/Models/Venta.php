<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['fecha_venta', 'empleado_id','ganancia'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
