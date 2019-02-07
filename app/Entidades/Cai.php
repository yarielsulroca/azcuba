<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Cai extends Model
{
    /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'nombre', 'municipio_id'
    ];

    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'cai';

    /**
     * Indica si el modelo tiene marca de tiempo
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Unidades que pertenecen a este cai
     *
     * @return App\Entidades\Unidad
     */
    public function unidades() {
        return $this->hasMany(Unidad::class);
    }

    /**
     * Municipio al que pertenece el CAI
     *
     * @return App\Entidades\Municipio
     */
    public function municipio () {
        return $this->belongsTo(Municipio::class);
    }

    public function mediciones () { 
        return $this->hasMany(Medicion::class);
    }
}