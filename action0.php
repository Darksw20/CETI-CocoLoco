<?php
//action.php
$connect = mysqli_connect('localhost', 'root', '', 'testing');

$input = filter_input_array(INPUT_POST);
$precio = mysqli_real_escape_string($connect, $input["precio"]);

if($input["action"] === 'edit'){
 $query = "
 UPDATE tbl_user
 SET precio = '".$precio."'
 WHERE idProducto = '".$input["idProducto"]."'
 ";
 mysqli_query($connect, $query);
}


echo json_encode($input);

?>
