<?php
	include('conexion_bd.php');
	$id = $_POST["id"];
	$text = $_POST["text"];
	$column_name = $_POST["column_name"];

	require_once('../lib/nusoap.php');

	$cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

	$parametros = array('CocoJAXWS' => '',
											'Columna' => $column_name,
											'Texto' => $text,
											'ID' => $id,
								);

	$resultado = $cliente->call('editAdmin', $parametros);

	print_r($resultado);

	/*$sql = "UPDATE Stocktaking SET ".$column_name."='".$text."' WHERE id='".$id."'";
	if(mysqli_query($con, $sql))
	{
		echo '¡Datos actualizados correctamente!';
	}*/
 ?>
