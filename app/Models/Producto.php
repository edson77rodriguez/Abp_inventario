<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_id',
        'marca_id',
        'talla_id',
        'genero_id',
        'modelo_id',
        'color_id',
        'composicion_id',
        'estilo_id',
        'precio_compra',
       'precio_venta',
        'proveedor_id',
    

    ];  
    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function talla()
    {
        return $this->belongsTo(Talla::class);
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function composicion()
    {
        return $this->belongsTo(Composicion::class);
    }

    public function estilo()
    {
        return $this->belongsTo(Estilo::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
