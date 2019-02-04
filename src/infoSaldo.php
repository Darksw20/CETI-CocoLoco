<?php
  include('conexion_bd.php');
  session_start();
  $user = $_SESSION['User_Name'];
  $userpa = $_SESSION['Password'];
  $saldoNuevo = $con->real_escape_string($_POST['saldoNuevo']);
  $pass = $con->real_escape_string($_POST['pass']);
  if (!empty($saldoNuevo) && !empty($pass)){
    if($userpa == $pass){
      require_once('../lib/nusoap.php');

      $cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

      $parametros = array('CocoJAXWS' => '',
                          'User_Name' => $user,
                          );

      $resultado = $cliente->call('amountUser', $parametros);

      print_r($resultado);
      /*$selectSaldo = "SELECT Amount From User WHERE User_Name = '$user'";
      $resultSaldo = mysqli_query($con, $selectSaldo);
      $fila = mysqli_fetch_array($resultSaldo);*/
      $saldo = $fila["Amount"];
      $saldoNuevo = $saldo + $saldoNuevo;
      require_once('../lib/nusoap.php');

      $cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

      $parametros = array('CocoJAXWS' => '',
                          'User_Name' => $user,
                          );

      $resultado = $cliente->call('amountUpdate', $parametros);

      print_r($resultado);
      /*$sql = "UPDATE User SET Amount = '$saldoNuevo' WHERE User_Name = '$user' ";
      $sentencia = $con->prepare($sql);
      $sentencia->execute();
      $sentencia->close();*/
    }
  }
  Header('Location: ../index.php');
?>
