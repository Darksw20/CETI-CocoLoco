<?php 
    require('conexion_bd.php');
    session_start();
    if(!$_SESSION){
        echo "No";
    }
    else{
        $sesion = $_SESSION['Id_Session'];
        $User = $_SESSION['User_Name'];
        //echo $sesion."-".$User;
        $sql = "SELECT IFNULL(COUNT(Sesion),'0') AS Comprueba FROM User WHERE User_Name='$User' AND Sesion='$sesion' LIMIT 1";
        $resultado = mysqli_query($con,$sql);
        //echo mysqli_error($con);
        $dato=0;
        
        while($fila=$resultado->fetch_assoc()){
            $dato=$fila['Comprueba'];
        }
        if($dato==1){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    mysqli_close($con);
?>