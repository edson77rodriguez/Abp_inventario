<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'nombre',
        'ap_p',
        'ap_m',
        'id_genero',
        'telefono',
        'id_cargo',
        
    ]; 
}
