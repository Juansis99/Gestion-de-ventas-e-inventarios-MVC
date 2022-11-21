<?php

	/*
		Pequeño, muy pequeño sistema de ventas en PHP con MySQL
		@author parzibyte (modificado Juansis99)
		No olvides visitar parzibyte.me/blog para más cosas como esta
	*/
	
	// modificado para tener variables de entorno en la conexion
	try {
		$base_de_datos = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
		$base_de_datos->query("set names utf8;");
		$base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
		$base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	} catch(Exception $e) {
		echo "Ocurrió algo con la base de datos: " . $e -> getMessage();
	}

?>