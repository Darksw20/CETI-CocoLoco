<?php
  require('conexion_bd.php');

  $oldPass = $con->real_escape_string($_POST['modPasswordOld']);
  $newPass = $con->real_escape_string($_POST['contrasenaMod']);
  $newPass2 = $con->real_escape_string($_POST['contraseMod2']);
  $user = $con->real_escape_string($_POST['user']);

  if(!empty($oldPass) && !empty($newPass) && !empty($newPass2)){
    if($oldPass == $_POST['modPasswordOld']){
      if($newPass == $newPass2){
        $consulta = mysqli_query($con, "UPDATE user SET Password = '$newPass' WHERE User_Name = '$user'");
        $msg = "Se cambió la contraseña.";
        header('Location: ../index.php?msg='.$msg);
      } else {
        echo "Las contraseñas no coinciden.";
      }
    }
  } else {
    echo "Rellene todos los campos por favor.";
  }

?>
