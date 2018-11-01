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
    $sql = "UPDATE User SET Name = '$nombreUsuario', Last_Name = '$apellido', Phone_Number = '$telefono',  Adress = '$calle' WHERE User_Name = '$user'";
    $sentencia = $con->prepare($sql);
    $sentencia->execute();
    $sentencia->close();
    if($sql){
      if( !empty($colonia) && !empty($nombreUsuario)){
        $sql1 = "UPDATE User SET Neighborhood_Code = '$colonia' WHERE User_Name='$user'";
        $sentencia = $con->prepare($sql1);
        $sentencia->execute();
        $sentencia->close();
        echo mysqli_error($con);
      }
    }
    header("Location: ../index.php");
  } else {
    echo "string";
  }
?>
