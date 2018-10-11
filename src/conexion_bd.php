<?php
	$servidor = "localhost";
	$usuario = "root";
	$contraseña = "";
	$basedatos = "invoice";
	
	$con = mysqli_connect ($servidor, $usuario, $contraseña)
	or die
	("No se puede conectar con el servidor");

	mysqli_select_db ($con, $basedatos)
	or die
	("No se puede conectar con la base de datos");
?>