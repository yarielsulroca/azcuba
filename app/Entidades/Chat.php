<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'comentario', 'medicion_id', 'user_id'
    ];

    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'medicion_chat';

    /**
     * Indica si el modelo tiene marca de tiempo
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Usuario asociado
     *
     * @return App\Entidades\User
     */
    public function usuario () {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Unidad asociada
     *
     * @return App\Entidades\Unidad
     */
    public function medicion () {
        return $this->belongsTo(Medicion::class);
    }
}