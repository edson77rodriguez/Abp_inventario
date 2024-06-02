<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Persona extends Model
{
    
    protected $perPage = 20;

    
    protected $fillable = ['nombre', 'ap_p', 'ap_m', 'telefono', 'correo'];


}
