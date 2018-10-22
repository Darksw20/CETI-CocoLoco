<?php

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
			$nombre_administrador = $fila["User_User_Name"];

			//CONSULTA PARA CREDITO DEL ADMINISTRADOR
			$selectQuery3 = "SELECT Amount FROM User WHERE Type_user = 2 AND User_Name = '$nombre_administrador'";
			$consulta_creditoadmin = mysqli_query ($con, $selectQuery3) or die ("Fallo con la consulta para obtener el credito del administrador");
			$fila = mysqli_fetch_array ($consulta_creditoadmin);
			$credito_admin = $fila["Amount"];

			//CONSULTA PARA LA CANTIDAD DEL PRODUCTO DEL ADMINISTRADOR
			$selectQuery4 = "SELECT Lot FROM Stocktaking WHERE User_User_Name = '$nombre_administrador'  AND Product_Name = '$nombre_producto'";
			$consulta_inventproductadmin = mysqli_query ($con, $selectQuery4) or die ("Fallo con la consulta para obtener los productos del administrador");
			echo mysqli_error($con);
			$fila = mysqli_fetch_array ($consulta_inventproductadmin);
			$productos_admin = $fila["Lot"];

			if($total > $credito_usuario){
				echo "No se  cuenta con el suficiente credito.";
				break;
			}

			else{
				//OPERACIONES
				$credito_usuario = $credito_usuario - $total;
				$credito_admin = $credito_admin + $total;
				$productos_admin = $productos_admin - $cantidad_productos;


				$query = "UPDATE User SET Amount = '$credito_usuario' WHERE User_Name = '$user'" ;
				//CONSULTA PARA ACTUALIZAR EL CREDITO DEL USUARIO
				$consulta_guardaruscrd = mysqli_query ($con, $query) or die ("Fallo con actualizar el credito del usuario");

				$query2 = "UPDATE User SET Amount = '$credito_admin' WHERE Type_user = 2 AND User_Name = '$nombre_administrador'";
				//CONSULTA PARA ACTUALIZAR EL CREDITO DEL ADMINISTRADOR
				$consulta_guardaruadcrd = mysqli_query ($con, $query2) or die ("Fallo con actualizar el credito del administrador");

				$query3 = "UPDATE Stocktaking SET Lot = '$productos_admin' WHERE User_User_Name = '$nombre_administrador' AND Product_Name = '$nombre_producto'";
 				//CONSULTA PARA ACTUALIZAR EL PRODUCTO DEL ADMINISTRADOR
				$consulta_guardaradminprod = mysqli_query($con, $query3) or die ("Fallo con actualizar los productos del administrador");

			}
		}
	}

?>