<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'lote_id'
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
    protected $table = 'medicion_bloque';

    /**
     * Lote al cual pertenece el bloque.
     *
     * @return App\Entidades\Lote
     */
    public function lote() {
        return $this->belongsTo(Lote::class);
    }
}