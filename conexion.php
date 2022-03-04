<?php

	$host ='localhost';   //el nombre del servidor
	$user = 'root';       //usuario
	$password = '';       //contraseña
	$db = 'facturacion';  //nombre de nuestra base de datos

	//conexion

	$conection = @mysqli_connect($host, $user, $password, $db);
	
	if(!$conection){
		echo "Error en la conexión";
	}
	
 ?>