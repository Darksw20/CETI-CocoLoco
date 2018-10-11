<?php
//action.php
$connect = mysqli_connect('localhost', 'root', '', 'testing');

$input = filter_input_array(INPUT_POST);

$nomProd = mysqli_real_escape_string($connect, $input["nomProd"]);
$precio = mysqli_real_escape_string($connect, $input["precio"]);
$descripcion = mysqli_real_escape_string($connect, $input["descripcion"]);
$cat = mysqli_real_escape_string($connect, $input["cat"]);

if($input["action"] === 'edit'){
 $query = "
 UPDATE tbl_user
 SET nomProd = '".$nomProd."',
 precio = '".$precio."',
 descripcion = '".$descripcion."',
 cat = '".$cat."'
 WHERE idProducto = '".$input["idProducto"]."'
 ";
 mysqli_query($connect, $query);
}

if($input["action"] === 'delete'){
 $query = "
 DELETE FROM tbl_user
 WHERE idProducto = '".$input["idProducto"]."'
 ";
 mysqli_query($connect, $query);
}

echo json_encode($input);

?>
