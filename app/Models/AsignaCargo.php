<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AsignaCargo
 *
 * @property $id
 * @property $empleado_id
 * @property $cargo_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Cargo $cargo
 * @property Empleado $empleado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AsignaCargo extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['empleado_id', 'cargo_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cargo()
    {
        return $this->belongsTo(\App\Models\Cargo::class, 'cargo_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'empleado_id', 'id');
    }
    
}
