<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
     /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'codigo', 'cai_id', 'tipo_id'
    ];

    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'unidad';

    /**
     * Indica si el modelo tiene marca de tiempo
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Cai al que pertenece
     *
     * @return App\Entidades\Cai
     */
    public function cai () {
        return $this->belongsTo(Cai::class);
    }

    /**
     * Tipo de unidad
     *
     * @return App\Entidades\TipoUnidad
     */
    public function tipo () {
        return $this->belongsTo(TipoUnidad::class);
    }   

    public function scopePorCai( $query, $caiId ) {
        if( $caiId>0 ) $query->where('cai_id', $caiId);

        return $query;
    }

    public function scopePorTipo( $query, $tipoId ) {
        if( $tipoId>0 ) $query->where('tipo_id', $tipoId);

        return $query;
    }
}