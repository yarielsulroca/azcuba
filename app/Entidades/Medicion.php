<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Medicion extends Model
{
    /**
     * Atributos asignables de la entidad
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'estado_id', 'cai_id', 'fichero'
    ];

    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'medicion';

    /**
     * Indica si el modelo tiene marca de tiempo
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Usuario que realizo la medicion
     *
     * @return App\Entidades\User
     */
    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Municipio al que pertenece el CAI
     *
     * @return App\Entidades\EstadoMedicion
     */
    public function estado () {
        return $this->belongsTo(EstadoMedicion::class, 'estado_id');
    }

    public function scopePorEstado( $query, $estado=null ) { 
        if( $estado >0 ) return $query->where('estado_id', $estado);
        return $query;
    }

    public function scopePorAnno( $query, $anno=null ) { 
        //if( !is_null($anno) ) return $query->where('estado_id', $estado);
        return $query;
    }

    public function scopePorCai( $query, $cai=null ) { 
        if( $cai >0 ) return $query->where('cai_id', $cai);
        return $query;
    }

    /**
     * Unidad a la q pertenece la medicion
     *
     * @return App\Entidades\Unidad
     */
    public function cai () {
        return $this->belongsTo(Cai::class);
    }

    public function scopeDespuesDeZafra( $query, $year ) {
        return $query->where( \DB::raw('year(created_at)'), $year)
                     ->where( \DB::raw('month(created_at)'), 7 );
    }

    public function scopeAntesDeZafra( $query, $year ) {
        return $query->where( \DB::raw('year(created_at)'), $year)
                     ->where( \DB::raw('month(created_at)'), 10 );
    }

    public function scopePorUsuario( $query, User $usuario = null ) {
        if(!is_null($usuario)) {
            $cais_asignados = $usuario->cais->pluck('id')->toArray();
            return $query->whereIn('cai_id', $cais_asignados);
        }

        return $query;
    }

    public function estaRechazada () {
        return $this->estado_id == 3;
    }

    public function estaAprobada () {
        return $this->estado_id == 2;
    }

    public function estaSolicitada () {
        return $this->estado_id == 1;
    }

    /**
     * Recomendacion asociada a esta medicion.
     *
     * @return 
     */
    public function recomendacion() {
        return $this->belongsTo( Recomendacion::class );
    }

    /**
     * Lineas de chat asociadas a esta medicion.
     *
     * @return 
     */
    public function chat() {
        return $this->hasMany( Chat::class );
    }    
}