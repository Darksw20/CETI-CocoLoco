<?php
require('conexion_bd.php');

$oldPass = $con->real_escape_string($_POST['passOld']);
$newPass = $con->real_escape_string($_POST['newPwd']);
$newPass2 = $con->real_escape_string($_POST['newPwd2']);
$user = $con->real_escape_string($_POST['user']);

require_once('../lib/nusoap.php');

$cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

$parametros = array('CocoJAXWS' => '',
                    'User_Name' => $user,
                    );

$resultado = $cliente->call('modificarPassComparar', $parametros);

print_r($resultado);
//$consulta = "SELECT Password FROM User where User_Name='$user'";
//$result2= mysqli_query($con, $consulta);

    //while ($row2=mysqli_fetch_array($result2)) {
      $pass = $row2["Password"];
    //}

     if($oldPass == $pass){
       if(!empty($oldPass) && !empty($newPass) && !empty($newPass2)){
         if($oldPass == $_POST['passOld']){
           if($newPass == $newPass2){
            require_once('../lib/nusoap.php');

            $cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

            $parametros = array('CocoJAXWS' => '',
                                'User_Name' => $user,
                                );

            $resultado = $cliente->call('modificarPass', $parametros);

            print_r($resultado);
            /*$sql = "UPDATE User SET Password = '$newPass' WHERE User_Name = '$user'";

            $sentencia = $con->prepare($sql);
            $sentencia->execute();
            $sentencia->close();*/

            $msg = "Se cambió la contraseña.";
            header('Location: ../index.php?msg='.$msg);
    } else {
      $msg = "las contraseñas no coinciden.";
     header('Location: ../index.php?msg='.$msg);
    }
  }
} else {
  echo "Rellene todos los campos por favor.";
}
}
else{
  $msg = "La contraseña no es antigua es correcta";
    header('Location: ../index.php?msg='.$msg);
}


?>
