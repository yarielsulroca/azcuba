<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'codigo'
    ];

    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'provincia';

    /**
     * Indica si el modelo tiene marca de tiempo
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Provincia asociada
     *
     * @return 
     */
    public function municipios () {
        return $this->hasMany(Municipio::class);
    }
}