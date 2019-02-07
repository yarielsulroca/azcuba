<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];

    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'municipio';

    /**
     * Indica si el modelo tiene marca de tiempo
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Provincia asociada
     *
     * @return App\Entidades\Provincia
     */
    public function provincia () {
        return $this->belongsTo(Provincia::class);
    }

    /**
     * 
     */ 
    public function campos() {
        return $this->hasMany( Campo::class, 'municipio_id');
    }

    /**
     * Filtra los municipios por un ID de provincia dado
     */ 
    public function scopePorProvincia( $query, $criterio ) { 
        if( $criterio > 0 ) $query->where('provincia_id', $criterio);

        return $query;
    }
}