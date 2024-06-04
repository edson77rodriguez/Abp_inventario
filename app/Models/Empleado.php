<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'cargo_id',
        'fecha_inicio',
        'fecha_fin',
        // otros campos relevantes
    ];

    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
