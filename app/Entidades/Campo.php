<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'area', 'uso_actual', 'uso_propuesto', 'area_guardada', 'bloque_id', 'municipio_id', 'estado_id'
    ];

    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'medicion_campo';

    /**
     * Indica si el modelo tiene marca de tiempo
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Bloque al cual se asocia
     *
     * @return 
     */
    public function bloque() {
        return $this->belongsTo(Bloque::class);
    }

    /**
     * Municipio al que pertenece 
     *
     * @return App\Entidades\Municipio
     */
    public function municipio () {
        return $this->belongsTo(Municipio::class);
    }

    /**
     * Estado del campo
     *
     * @return App\Entidades\EstadoCampo
     */
    public function estado () {
        return $this->belongsTo(EstadoCampo::class);
    }
}
