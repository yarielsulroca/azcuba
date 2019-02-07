<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class EstadoCampo extends Model
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
    protected $table = 'campo_estado';    

    /**
     * Campos que estan en este estado
     *
     * @return void
     */
    public function campos () {
        return $this->hasMany( Campo::class, 'estado_id' );
    }
}