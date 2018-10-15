<?php
    //Se requiere tener la conexión a la BD
    require ('conexion_bd.php');
    /*
    * Se reciven los datos del formulario de registro
    * $con->real_escape_string Escapa la cadena de simbolos no admitidos
    */
    $emailRegistro = $con->real_escape_string($_POST['emailRegistro']);
    $nombreUsuario = $con->real_escape_string($_POST['nombreUsuario']);
    $nombreUser = $con->real_escape_string($_POST['nombreUser']);
    $apellidoUsuario = $con->real_escape_string($_POST['apellidoUsuario']);
    $passwordRegistro = $con->real_escape_string($_POST['passwordRegistro']);
    $passwordRegistro2 = $con->real_escape_string($_POST['passwordRegistro2']);
    //Se declaran variables para que el usuario las modifique despues
    $amount = '500'; //Saldo se inicia en 0 por defecto
    $type_User = '0'; //El tipo de usuario por defecto es 0 (usuario)
    $phone = '0'; //El telefono por defecto es 0
    $address = '60'; //La dirección por defecto es 1 (Ninguna (Así asignado en la BD))

    //Se insertan los datos en la tabla 'user'
    $sql = mysqli_query($con, "INSERT INTO user(`User_Name`, `Password`, `Mail`, `Amount`, `Type_User`, `Name`, `Last_Name`, `Phone_Number`, `Adress_Code`) VALUES ('$nombreUser', '$passwordRegistro', '$emailRegistro', '$amount', '$type_User', '$nombreUsuario', '$apellidoUsuario', '$phone', '$address')"); 
    if ($sql) {
        //echo "EXITO";
        //Si se realizó la consulta, se regresa al usuario a la página principal
        header('Location: ../index.php');
    } else {
        //Si no se realizó la consulta se muestra un mensaje de error.
        echo "Error: ".mysqli_error($con)." <br />";
        echo "Usuario: ".$nombreUser."<br> Pass: ".$passwordRegistro."<br> Mail: ".$emailRegistro."<br> Saldo: ".$amount."<br> Tipo: ".$type_User."<br> Nombre: ".$nombreUsuario."<br> Apellidos: ".$apellidoUsuario."<br> Cel: ".$phone."<br> Dirección: ".$address;
    }
?>