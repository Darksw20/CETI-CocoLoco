<?php
  require('conexion_bd.php');

  $nombreUsuario = $con->real_escape_string($_POST['nombreUsuario']);
  $apellido = $con->real_escape_string($_POST['apellidoUsuario']);
  $telefono = $con->real_escape_string($_POST['tel']);
  $calle = $con->real_escape_string($_POST['calle']);
  $colonia = $con->real_escape_string($_POST['colonia']);
  $user = $con->real_escape_string($_POST['user']);
  $code = $con->real_escape_string($_POST['code']);

  if(!empty($nombreUsuario) && !empty($apellido) && !empty($telefono) && !empty($calle) ){
    $sql = "UPDATE User SET Name = '$nombreUsuario', Last_Name = '$apellido', Phone_Number = '$telefono',  Adress = '$calle' WHERE User_Name = '$user' ";
    $sentencia = $con->prepare($sql);
    $sentencia->execute();
    $sentencia->close();
    if($sql){
      if( !empty($colonia)){
        $sql = "UPDATE Neighborhood SET Name = '$colonia' WHERE Code = '$code' ";
        $sentencia = $con->prepare($sql);
        $sentencia->execute();
        $sentencia->close();
      }
    }
    header("Location: ../index.php");
  } else {
    echo "string";
  }
?>
