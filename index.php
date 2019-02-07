<?php

	$fichero = 'C:\\sandy\\caña.accdb';

	$uname = explode(" ", php_uname());
	$os = $uname[0];
	
	if($os=='Windows') {
	    $driver = '{Microsoft Access Driver (*.mdb, *.accdb)}'; 
	}
	elseif($os=='Linux') { 
	    $driver = 'MDBTools';
	}
	else { 
	 	throw new Exception("No tienes instalado el driver odbc para el interprete de PHP", 1);
	}

	$fuente = "odbc:Driver=$driver;DBQ=$fichero";
	echo $fuente;

	$conexion = new \PDO( $fuente );
	$result = $conexion->query('select * from Caña')->fetchAll( PDO::FETCH_ASSOC ); // Esta por ver el nombre de la tabla.

	print_r( $result );