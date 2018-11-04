<?php
/*
	//CONEXION AL SERVIDOR Y BASE DE DATOS
include('conexion_bd.php');

	//VARIABLES DE USO
	session_start();
	$user=$_SESSION['User_Name']; //PONER LA VERDADERA
	$carrito = $_SESSION['shopping_cart'];

	if(!empty($_SESSION["shopping_cart"])){
		foreach ($_SESSION["shopping_cart"] as $key => $values) {

			$nombre_producto = $values["product_name"];
			$cantidad_productos = $values["product_quantity"];
			$precio_producto = $values["product_price"];
			$total = $precio_producto * $cantidad_productos;

			//CONSULTA PARA CREDITO DEL USUARIO
			$selectQuery = "SELECT Amount FROM User WHERE User_Name = '$user'";
			$consulta_creditous = mysqli_query ($con, $selectQuery) or die ("Fallo con la consulta para obtener el credito del usuario");
			$fila = mysqli_fetch_array ($consulta_creditous);
			$credito_usuario = $fila["Amount"];

			//CONSULTA PARA NOMBRE DEL ADMINISTRADOR
			$selectQuery2 = "SELECT User_User_Name FROM Stocktaking WHERE Product_Name = '$nombre_producto'";
			$consulta_nombreadmin = mysqli_query ($con, $selectQuery2) or die ("Fallo con la consulta para obtener el nombre del administrador");
			$fila = mysqli_fetch_array ($consulta_nombreadmin);
			$User_User_Name = $fila["User_User_Name"];

			//CONSULTA PARA CREDITO DEL ADMINISTRADOR
			$selectQuery3 = "SELECT Amount FROM User WHERE Type_user = 2 AND User_Name = '$User_User_Name'";
			$consulta_creditoadmin = mysqli_query ($con, $selectQuery3) or die ("Fallo con la consulta para obtener el credito del administrador");
			$fila = mysqli_fetch_array ($consulta_creditoadmin);
			$credito_admin = $fila["Amount"];

			//CONSULTA PARA LA CANTIDAD Y EL ID DEL PRODUCTO DEL ADMINISTRADOR
			$selectQuery4 = "SELECT Lot, ID FROM Stocktaking WHERE User_User_Name = '$User_User_Name'  AND Product_Name = '$nombre_producto'";
			$consulta_inventproductadmin = mysqli_query ($con, $selectQuery4) or die ("Fallo con la consulta para obtener los productos del administrador");
			echo mysqli_error($con);
			$fila = mysqli_fetch_array ($consulta_inventproductadmin);
			$productos_admin = $fila["Lot"];
			$productosID_admin = $fila["ID"];

			if($total > $credito_usuario){

			}

			else{
				//OPERACIONES
				$credito_usuario = $credito_usuario - $total;
				$credito_admin = $credito_admin + $total;
				$productos_admin = $productos_admin - $cantidad_productos;


				$query = "UPDATE User SET Amount = '$credito_usuario' WHERE User_Name = '$user'" ;
				//CONSULTA PARA ACTUALIZAR EL CREDITO DEL USUARIO
				$consulta_guardaruscrd = mysqli_query ($con, $query) or die ("Fallo con actualizar el credito del usuario");

				$query2 = "UPDATE User SET Amount = '$credito_admin' WHERE Type_user = 2 AND User_Name = '$User_User_Name'";
				//CONSULTA PARA ACTUALIZAR EL CREDITO DEL ADMINISTRADOR
				$consulta_guardaruadcrd = mysqli_query ($con, $query2) or die ("Fallo con actualizar el credito del administrador");

				$query3 = "UPDATE Stocktaking SET Lot = '$productos_admin' WHERE User_User_Name = '$User_User_Name' AND Product_Name = '$nombre_producto'";
 				//CONSULTA PARA ACTUALIZAR EL PRODUCTO DEL ADMINISTRADOR
				$consulta_guardaradminprod = mysqli_query($con, $query3) or die ("Fallo con actualizar los productos del administrador");

				date_default_timezone_get('america/mexico_city');
				$fechas = date("Y-m-d H:i:s:u");
				$query4 = "INSERT INTO Transaction (Date, Amount, User_User_Name, Stocktaking_ID) VALUES ('$fechas', '$total', '$User_User_Name', '$productosID_admin')";
 				//CONSULTA PARA GENERAR LA TRANSACCION DEL PRODUCTO
				$consulta_guardartranustoadmin = mysqli_query($con, $query4) or die ("Fallo la transaccion de usario a administrador");

				$msgSuccess = "Compra realizada con exito";
				 unset($_SESSION["shopping_cart"]);
				 header('Location: ../departamentos.php?msgSuccess='.$msgSuccess);

			}
		}
	}

*/

include('conexion_bd.php');
$SERMO = mysqli_autocommit($con, FALSE);
session_start();
$user = $_SESSION["User_Name"];
$total_price = 0;
$total_item = 0;


if (!empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $key => $values) {

    $Product_Name = $values["product_name"];
    $cantidad_productos = $values["product_quantity"];
    $precio_producto = $values["product_price"];
    //CONSULTA PARA CREDITO DEL USUARIO

    $selectQuery = "SELECT Amount FROM User WHERE User_Name = '$user'";
    $consulta_creditous = mysqli_query ($con, $selectQuery) or die ("Fallo con la consulta para obtener el credito del usuario");
    $fila = mysqli_fetch_array ($consulta_creditous);
    $Amount = $fila["Amount"];
    //CONSULTA PARA NOMBRE DEL ADMINISTRADOR

    $selectQuery2 = "SELECT User_User_Name FROM Stocktaking WHERE Product_Name = '$Product_Name'";
    $consulta_nombreadmin = mysqli_query ($con, $selectQuery2) or die ("Fallo con la consulta para obtener el nombre del administrador");
    $fila = mysqli_fetch_array ($consulta_nombreadmin);
    $User_User_Name = $fila["User_User_Name"];

    //CONSULTA PARA CREDITO DEL ADMINISTRADOR
    $selectQuery3 = "SELECT Amount FROM User WHERE Type_user = 2 AND User_Name = '$User_User_Name'";
    $consulta_creditoadmin = mysqli_query ($con, $selectQuery3) or die ("Fallo con la consulta para obtener el credito del administrador");
    $fila = mysqli_fetch_array ($consulta_creditoadmin);
    $credito_admin = $fila["Amount"];

    //CONSULTA PARA LA CANTIDAD Y EL ID DEL PRODUCTO DEL ADMINISTRADOR
    $selectQuery4 = "SELECT * FROM Stocktaking WHERE User_User_Name = '$User_User_Name'  AND Product_Name = '$Product_Name'";
    $consulta_inventproductadmin = mysqli_query ($con, $selectQuery4) or die ("Fallo con la consulta para obtener los productos del administrador");
    echo mysqli_error($con);
    $fila = mysqli_fetch_array ($consulta_inventproductadmin);
    $Lot = $fila["Lot"];
    $ID = $fila["ID"];
    $Rate = $fila["Rate"];
    $Product_Description = $fila["Product_Description"];
    $Class = $fila ["Class"];
    $SubClass = $fila ["SubClass"];
    $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
    $total_item = $total_item + 1;
    $total = $precio_producto * $cantidad_productos;
    $Amount = $Amount - $total;
    $credito_admin = $credito_admin + $total;

		$timezone = new DateTimeZone('america/mexico_city');
		$micro_date = microtime();
		$date_array = explode(" ", $micro_date);
		$Date =  Date("Y-m-d H:m:s", $date_array[1]);
		$Date1 = $Date.$date_array[0];
		$query4 = "INSERT INTO Auxiliar (ID, Product_Name, Lot, Rate, Product_Description, Class, SubClass, User_User_Name, Date, Amount) VALUES ('$ID', '$Product_Name', '$Lot', '$Rate', '$Product_Description', '$Class', '$SubClass', '$User_User_Name', '$Date1', '$total')";

		mysqli_query($con,$query4) or die ("Fallo porque estas bien wey");
		mysqli_commit($con); // esta mamada se necesita awebo!!!!! Me lleva la macana #2h

		$selectQuery5 = "SELECT * FROM Auxiliar";
    $resultQuery5 = mysqli_query($con,$selectQuery5) or die ("Fallo porque estas bien wey");
		$selectQuery6 = "SELECT * FROM Stocktaking WHERE ID = '$ID'  AND Product_Name = '$Product_Name'";
    $resultQuery6 = mysqli_query($con,$selectQuery6) or die ("Fallo porque estas bien wey");
		$selectQuery62 = "SELECT * FROM Auxiliar WHERE ID = '$ID'  AND Product_Name = '$Product_Name'";
    $resultQuery62 =mysqli_query($con,$selectQuery62) or die ("Fallo porque estas bien wey");

    echo $Lot;
    echo $cantidad_productos;

		//echo $cantidad_productos." ".$Lot;
		if ($cantidad_productos <= $Lot){
			if($Amount < $total){

        $msgError = "La compra no se pudo realizar";
        header('Location: ../departamentos.php?msgError='.$msgError);
        break;

			}else{
				$varita = mysqli_num_rows($resultQuery62);
				mysqli_error($con);
				if($varita >= 2){
					$selectQuery7 = "SELECT Date FROM auxiliar WHERE ID = '$ID' ORDER BY Date DESC";
          mysqli_query($con, $selectQuery7);
				}
				else{
					$queryChida = "INSERT INTO Transaction (Date, Amount, User_User_Name, Stocktaking_ID) VALUES ('$Date', '$total', '$user', '$ID')";
					$consulta_guardartranustoadmin = mysqli_query($con, $queryChida) or die ("Fallo la transaccion de usario a administrador");
					mysqli_commit($con); // esta mamada se necesita awebo!!!!! Me lleva la macana #2h

					$query = "UPDATE User SET Amount = '$Amount' WHERE User_Name = '$user'" ;
					$consulta_guardaruscrd = mysqli_query ($con, $query) or die ("Fallo con actualizar el credito del usuario");
          //CONSULTA PARA ACTUALIZAR EL CREDITO DEL USUARIO

					$query2 = "UPDATE User SET Amount = '$credito_admin' WHERE Type_user = 2 AND User_Name = '$User_User_Name'";
					$consulta_guardaruadcrd = mysqli_query ($con, $query2) or die ("Fallo con actualizar el credito del administrador");
          //CONSULTA PARA ACTUALIZAR EL CREDITO DEL ADMINISTRADOR

          $Lot = $Lot - $cantidad_productos;
					$query3 = "UPDATE Stocktaking SET Lot = '$Lot' WHERE User_User_Name = '$User_User_Name' AND Product_Name = '$Product_Name'";
					$consulta_guardaradminprod = mysqli_query($con, $query3) or die ("Fallo con actualizar los productos del administrador");
          //CONSULTA PARA ACTUALIZAR EL PRODUCTO DEL ADMINISTRADOR

					$queryFinal = "DELETE FROM Auxiliar WHERE Product_Name = '$Product_Name'";
          mysqli_query($con, $queryFinal);
          unset($_SESSION["shopping_cart"]);

          $msgSuccess = "Compra realizada con exito";
          header('Location: ../departamentos.php?msgSuccess='.$msgSuccess);

          mysqli_commit($con);
          $SERMO = mysqli_autocommit($con, TRUE);
				}
			}
		}else{
			echo "error, no hay stock";
		}

	}

}



?>
