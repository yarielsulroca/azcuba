<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Recomendacion extends Model
{
    /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'medicion_id', 'user_id', 'comentario'
    ];

    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'medicion_recomendacion';

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

    public function ficheros () {
        return $this->hasMany(FicheroRecomendacion::class, 'recomendacion_id');
    }     


    /**
     * Usuario asociado
     *
     * @return App\Entidades\User
     */
    public function medicion () {
        return $this->hasOne(Medicion::class);
    }
}