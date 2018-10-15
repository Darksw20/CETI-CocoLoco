<?php
	include('conexion_bd.php');
	$id = $_POST["id"];
	$text = $_POST["text"];
	$column_name = $_POST["column_name"];
	$sql = "UPDATE stocktaking SET ".$column_name."='".$text."' WHERE id='".$id."'";
	if(mysqli_query($con, $sql))
	{
		echo '¡Datos actualizados correctamente!';
	}
 ?>
