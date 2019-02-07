<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'medicion_id'
    ];

    /**
     * Indica si el modelo tiene marca de tiempo
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'medicion_lote';

    /**
     * Medicion a la que pertenece el lote
     *
     * @return App\Entidades\Municipio
     */
    public function medicion () {
        return $this->belongsTo(Medicion::class);
    }
}