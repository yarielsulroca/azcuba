<?php
	class Periodo { 

		 /**
	     * Atributos asignables de la entidad
	     *
	     * @var array
	     */
	    protected $fillable = [
	        'desde', 'hasta'
	    ];

	    /**
	     * Tabla que representa en la base de datos
	     *
	     * @var string
	     */
	    protected $table = 'periodos_subida';

	    /**
	     * Indica si el modelo tiene marca de tiempo
	     *
	     * @var bool
	     */
	    public $timestamps = true;
	}