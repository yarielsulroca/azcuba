<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class TipoUnidad extends Model
{
    /**
     * Tabla que representa en la base de datos
     *
     * @var string
     */
    protected $table = 'unidad_tipo';

    /**
     * Indica si el modelo tiene marca de tiempo
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Unidades asociadas a este tipo.   
     *
     * @return 
     */        
    public function unidades () { 
        // return                                 
    }
    
    public static function filtrar( array $datos ) { 
        $c = array_get($datos, 'criteria');
        
        return self::when( $c!='', function($query) use($c) { 
            return $query->where('nombre', 'like', "%{$c}%");
        });
    }
}