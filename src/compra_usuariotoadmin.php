<?php


include('conexion_bd.php');
require_once('../lib/nusoap.php');
//$SERMO = mysqli_autocommit($con, FALSE);
session_start();
$user = $_SESSION["User_Name"];
$total_price = 0;
$total_item = 0;


if (!empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $key => $values) {

    $Product_Name = $values["product_name"];
    $cantidad_productos = $values["product_quantity"];
    $precio_producto = $values["product_price"];

    $cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

    //DATOS DEL USUARIO
    $parametrosAmount = array(
        'CocoJAXWS' => '',
        'User_Name' => $user,
    );
    $resultadoAmount = $cliente->call('consultaAmount', $parametrosAmount);
    $Name = $resultadoAmount['return']['name'];
    $LastName = $resultadoAmount['return']['lastName'];
    $phone = $resultadoAmount['return']['phoneNumber'];
    $password = $resultadoAmount['return']['password'];
    $mail = $resultadoAmount['return']['mail'];
    $addres = $resultadoAmount['return']['adress'];
    $nh = $resultadoAmount['return']['neighborhoodCode'];
    $tu = $resultadoAmount['return']['typeUser'];
    $session = $resultadoAmount['return']['sesion'];
    $AmountUser = $resultadoAmount['return']['amount'];

    //CONSULTA PARA DATOS DEL ADMINISTRADOR
    $parametrosAdmon = array(
        'CocoJAXWS' => '',
        'User_Name' => 'PedroAnt',
    );
    $resultadoAdmon = $cliente->call('consultaAmountAdmin', $parametrosAdmon);
    $AmountAdmin = $resultadoAdmon['return']['amount'];
    $NameAdmin = $resultadoAdmon['return']['name'];
    $LastNameAdmin = $resultadoAdmon['return']['lastName'];
    $phoneAdmin = $resultadoAdmon['return']['phoneNumber'];
    $passwordAdmin = $resultadoAdmon['return']['password'];
    $mailAdmin = $resultadoAdmon['return']['mail'];
    $addresAdmin = $resultadoAdmon['return']['adress'];
    $nhAdmin = $resultadoAdmon['return']['neighborhoodCode'];
    $tuAdmin = $resultadoAdmon['return']['typeUser'];
    $sessionAdmin = $resultadoAdmon['return']['sesion'];
    $userAdmin = $resultadoAdmon['return']['userName'];

    //CONSULTA PARA DATOS DEL PRODUCTO
    $parametrosStock = array(
        'CocoJAXWS' => '',
        'Product_Name' => $Product_Name,
    );
    $resultadoLot = $cliente->call('consultaLot', $parametrosStock);
    //var_dump($resultadoLot);
    $lot = $resultadoLot['return']['lot'];
    $ID = $resultadoLot['return']['id'];
    $Rate = $resultadoLot['return']['rate'];
    $Product_Description = $resultadoLot['return']['productDescription'];
    $Class = $resultadoLot['return']['class1'];
    $SubClass = $resultadoLot['return']['subClass'];
    $User_User_Name = $resultadoLot['return']['userUserName']['userName'];
    $imagen = $resultadoLot['return']['image'];

    $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
    $total_item = $total_item + 1;
    $total = $precio_producto * $cantidad_productos;
    $AmountUser = $AmountUser - $total;
    $AmountAdmin = $AmountAdmin + $total;

		$timezone = new DateTimeZone('america/mexico_city');
		$micro_date = microtime();
		$date_array = explode(" ", $micro_date);
		$Date =  Date("Y-m-d H:m:s", $date_array[1]);
		$Date1 = $Date.$date_array[0];

		if ($cantidad_productos <= $lot){
			if($AmountUser < $total){

        $msgError = "La compra no se pudo realizar";
        header('Location: ../departamentos.php?msgError='.$msgError);
        break;

			}else{

          //registrar transaccion
          $parametrosTransaction = array(
            'CocoJAXWS' => '',
            'Date' => $Date1,
            'Amount' => $total,
            'User_User_Name' => $user,
            'Stocktaking_ID' => $ID,
          );
          $resultadoTransaction = $cliente->call('insertTransaction', $parametrosTransaction);

          //actualizar DATOS
          $parametrosUpdate = array(
            'CocoJAXWS' => '',
            'User_Name' => $user,
            'Password' => $password,
            'Mail' => $mail,
            'Amount' => $AmountUser,
            'Type_User' => $tu,
            'Name' => $Name,
            'Last_Name' => $LastName,
            'Phone_Number' => $phone,
            'Adress' => $addres,
            'Neighborhood_Code' => $nh,
            'Sesion' => $session,

          );
          $actualizarDatosUser = $cliente->call('updateUser', $parametrosUpdate);

          $parametrosUpdateAdmin = array(
            'CocoJAXWS' => '',
            'User_Name' => $userAdmin,
            'Password' => $passwordAdmin,
            'Mail' => $mailAdmin,
            'Amount' => $AmountAdmin,
            'Type_User' => $tuAdmin,
            'Name' => $NameAdmin,
            'Last_Name' => $LastNameAdmin,
            'Phone_Number' => $phoneAdmin,
            'Adress' => $addresAdmin,
            'Neighborhood_Code' => $nhAdmin,
            'Sesion' => $sessionAdmin,
          );

          $actualizarDatosAdmin = $cliente->call('updateAdmin', $parametrosUpdateAdmin);
          $lot = $lot - $cantidad_productos;
          $parametrosUpdateStock = array(
            'CocoJAXWS' => '',
            'ID' => $ID,
            'Product_Name' => $Product_Name,
            'Lot' => $lot,
            'Rate' => $Rate,
            'Product_Description' => $Product_Description,
            'Class' => $Class,
            'SubClass' => $SubClass,
            'User_User_Name' => $User_User_Name,
            'Image' => $imagen,
          );
          $actualizarDatosStock = $cliente->call('updateStock', $parametrosUpdateStock);

          unset($_SESSION["shopping_cart"]);
          $msgSuccess = "Compra realizada con exito";
          header('Location: ../departamentos.php?msgSuccess='.$msgSuccess);
	       }

       }
     }
   }

?>
