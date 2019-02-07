<?php

	namespace App\Entidades;

	use Illuminate\Database\Eloquent\Model;

	class Traza extends Model
	{
		/**
	     * Indica los atributos que son rellenables en este modelo
	     *
	     * @var array
	     */
	    protected $fillable = [	       
	        'texto', 'user_id'
	    ];

	    /**
	     *  Tabla que identifica este modelo en la base de datos real
	     */
	    protected $table = 'log';

	    /**
	     * indica si el modelo debe de manejar las fechas de creacion - actualizacion
	     *
	     * @var bool
	     */
	    public $timestamps = true;   		

		/**
	     * Usuario asociado a la traza
	     * @return App\Entidades\User | Illuminate\Database\Eloquent\Relations\BelongsTo
	     */
	    public function usuario() { 
	    	return $this->belongsTo(User::class, 'user_id');
	    }	  

		/**
		 * Filtra por fecha desde
		 *
		 * @param        $query
		 * @param string $desde
		 * @return void
		 */
		public function scopeDesde( $query, $desde) {
			if( $desde!='' ) $query->where('created_at', '>=', $desde);
			return $query;
		}

		/**
		 * Filtra por fecha hasta
		 *
		 * @param        $query
		 * @param string $hasta
		 * @return void
		 */
		public function scopeHasta( $query, $hasta) {
			if( $hasta!='' ) $query->where('created_at', '<=', $hasta);
			return $query;
		}

		/**
		 * Filtra por usuario
		 *
		 * @param     $query
		 * @param int $user_id
		 * @return void
		 */
		public function scopeUsuario( $query, $user_id) {
			if( $user_id>0 ) $query->where('user_id', $user_id);
			return $query;
		}

		/**
		 * Filtra por un criterio especifico
		 *
		 * @param        $query
		 * @param string $criterio
		 * @return void
		 */
		public function scopeCriterio( $query, $criterio) {
			$query->where('texto', 'like', "%$criterio%");
			return $query;
		}
	}