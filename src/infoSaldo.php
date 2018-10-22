<?php
  include('conexion_bd.php');
  session_start();
  $saldo = $_SESSION['Amount'];
  $user = $_SESSION['User_Name'];
  $userpa = $_SESSION['Password'];
  $saldoNuevo = $con->real_escape_string($_POST['saldoNuevo']);
  $pass = $con->real_escape_string($_POST['pass']);
  if (!empty($saldoNuevo) && !empty($pass)){
    if($userpa == $pass){
      $saldoNuevo = $saldo + $saldoNuevo;
      $sql = "UPDATE User SET Amount = '$saldoNuevo' WHERE User_Name = '$user' ";
      $sentencia = $con->prepare($sql);
      $sentencia->execute();
      $sentencia->close();
    }
  }
  Header('Location: ../index.php');
?>
