<?php
//session_start();
include 'conexion_bd.php';

//Transacciones del día
function TransCount($con){
  date_default_timezone_set('america/mexico_city');
  $fechahoy = date("Y-m-d");
  $fecham1 = $fechahoy." 00:00:00";
  $fecham2 = $fechahoy." 23:59:59";
  $dato1 = mysqli_query($con, "SELECT IFNULL(COUNT(Rate), '0') FROM Transaction AS A INNER JOIN Stocktaking AS B ON A.stocktaking_ID = B.ID WHERE A.Date BETWEEN '$fecham1' AND '$fecham2'");
  while($row = mysqli_fetch_array($dato1)){
    $numeral = $row[0];
  }
  echo $numeral;
  }
//Total de productos
function ProdCount($con){
  $res = "SELECT IFNULL(COUNT(ID), '0') AS cuenta FROM Stocktaking";
  $resultado = $con->query($res);
  if (mysqli_num_rows($resultado) > 0) {
    while ($fila = $resultado->fetch_assoc()) {
      echo $fila['cuenta'];
    }
  }
}
//Total de usuarios
function UserCount($con){
    $res = 'SELECT User.Type_User, COUNT(*) AS cuenta FROM User WHERE Type_User = 0';
    $resultado = $con->query($res);
    if (mysqli_num_rows($resultado) > 0) {
      while ($fila = $resultado->fetch_assoc()) {
        echo $fila['cuenta'];
    }
  }
}
//Total de proveedores
function ProvCount($con){
  $res = 'SELECT User.Type_User, COUNT(*) AS cuenta FROM User WHERE Type_User = 1';
  $resultado = $con->query($res);
  if (mysqli_num_rows($resultado) > 0) {
    while ($fila = $resultado->fetch_assoc()) {
      echo $fila['cuenta'];
  }
}
}
?>    
