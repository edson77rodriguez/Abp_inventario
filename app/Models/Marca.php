<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Marca extends Model
{
    protected $perPage = 20;
    protected $fillable = ['Marca', 'origen_id'];
    public function origene()
    {
        return $this->belongsTo(\App\Models\Origene::class, 'origen_id', 'id');
    }
    
}
