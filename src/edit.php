<?php
	include('conexion_bd.php');
	$id = $_POST["id"];
	$text = $_POST["text"];
	$column_name = $_POST["column_name"];
	$sql = "UPDATE Stocktaking SET ".$column_name."='".$text."' WHERE id='".$id."'";

	$sentencia = $con->prepare($sql);
    $sentencia->execute();
	$sentencia->close();
	
	if($sql) {
		echo '¡Datos actualizados correctamente!';
	}
 ?>
