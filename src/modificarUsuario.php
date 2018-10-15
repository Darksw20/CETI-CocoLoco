<?php
  require('conexion_bd.php');
  $nombreUsuario =  con->real_escape_string($_POST['nombreUsuario']);
  $apellido = con->real_escape_string($_POST['apellidoPatUsuario']);
  $numTelefono = con->real_escape_string($_POST['telefono']);
  $codigoPostal = con->real_escape_string($_POST['codigoPostal']);
  if(!empty($nombreUsuario) && !empty($apellido) && !empty('telefono') && !empty($calle) && !empty('numeroCalle')&& !empty($colonia) && !empty($codigoPostal)){
    $consulta =mysqli_query($con,"UPDATE user SET Name = '$nombreUsuario', Last_Name = '$apellido', Phone_Number = '$telefono',  Address_Code = '$codigoPostal' WHERE User_Name = $_SESSION['User_Name'] ");
  } else {
    alert("Complete los campos para ser actualizados por favor");
  }
?>
