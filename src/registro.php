<?php
    //Se requiere tener la conexión a la BD
    require ('conexion_bd.php');
    /*
    * Se reciven los datos del formulario de registro
    * $con->real_escape_string Escapa la cadena de simbolos no admitidos
    */
    $emailRegistro = $con->real_escape_string($_POST['emailRegistro']);
    $nombreUsuario = $con->real_escape_string($_POST['nombreUsuario']);
    $apellidoUsuario = $con->real_escape_string($_POST['apellidoUsuario']);
    $passwordRegistro = $con->real_escape_string($_POST['passwordRegistro']);
    $passwordRegistro = sha1($passwordRegistro); //Se encripta la contraseña
    $passwordRegistro2 = $con->real_escape_string($_POST['passwordRegistro2']);
    //Se declaran variables para que el usuario las modifique despues
    $amount = '0'; //Saldo se inicia en 0 por defecto
    $type_User = '0'; //El tipo de usuario por defecto es 0 (usuario)
    $phone = '0'; //El telefono por defecto es 0
    $address = '1'; //La dirección por defecto es 1 (Ninguna (Así asignado en la BD))

    /*
    * Se crea el nombre de usuario por defecto, consta de la primer letra del nombre y el primer apellido.
    * preg_split() Separa la cadena al encontrar un espacio, esto para tomar el primer apellido.
    * $userName (Primera declaración) Aquí la variable se iguala a la primer letra del nombre y el primer apellido.
    * strtolower Se pone toda la cadena en minusculas.
    */
    $userLast = preg_split('" "', $apellidoUsuario, -1, PREG_SPLIT_NO_EMPTY);
    $userName = $nombreUsuario[0]."".$userLast[0]; //Se toma la primer letra del nombre y el primer apellido, respectivamente.
    $userName = strtolower($userName);
    //Se insertan los datos en la tabla 'user'
    $sql = mysqli_query($con, "INSERT INTO user(`User_Name`, `Password`, `Mail`, `Amount`, `Type_User`, `Name`, `Last_Name`, `Phone_Number`, `Address_Code`) VALUES ('$userName', '$passwordRegistro', '$emailRegistro', '$amount', '$type_User', '$nombreUsuario', '$apellidoUsuario', '$phone', '$address')"); 
    if ($sql) {
        //echo "EXITO";
        //Si se realizó la consulta, se regresa al usuario a la página principal
        header('Location: ../login.php');
    } else {
        //Si no se realizó la consulta se muestra un mensaje de error.
        echo "Error <br />";
        /*echo "Usuario: ".$userName."<br> Pass: ".$passwordRegistro."<br> Mail: ".$emailRegistro."<br> Saldo: ".$amount."<br> Tipo: ".$type_User."<br> Nombre: ".$nombreUsuario."<br> Apellidos: ".$apellidoUsuario."<br> Cel: ".$phone."<br> Dirección: ".$address;*/
    }
?>