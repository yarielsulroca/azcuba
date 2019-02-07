<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class FicheroRecomendacion extends Model
{
    /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'fichero', 'recomendacion_id', 'nombre_fichero'
    ];

    /**
     * Indica si el modelo tiene marca de tiempo
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'medicion_recomendacion_ficheros';    

    /**
     * Recomendacion asociada
     *
     * @return App\Entidades\Recomendacion
     */
    public function recomendacion () {
        return $this->belongsTo(Recomendacion::class);
    }
}