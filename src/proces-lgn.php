<?php
	require('conexion_bd.php');

	$correo = $con->real_escape_string($_POST['email']);
	$pass = $con->real_escape_string($_POST['password']);
		if (!empty($correo) && !empty($pass)) {
			//$pass = sha1($pass);
			$consulta = "SELECT * FROM user WHERE Mail = '$correo' AND Password = '$pass' LIMIT 1";
			$resultado = $con->query($consulta);
			if ($resultado->num_rows > 0) {
				$fila = $resultado->fetch_row();
				session_start();
				$_SESSION['User_Name'] = $fila[0];
				$_SESSION['Mail'] = $correo;
				$_SESSION['Amount'] = $fila[3];
				$_SESSION['Type_User'] = $fila[4];
				$_SESSION['Name'] = $fila[5];
				$_SESSION['Last_Name'] = $fila[6];
				$_SESSION['Phone_Number'] = $fila[7];
				$_SESSION['Address_Code'] = $fila[8];
				header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				if($_SESSION['Type_User'] == 0){
					header("Location: ../index.php");
				} elseif ($_SESSION['Type_User'] == 1) {
					header("Location: ../panelProveedor.php");
				}	elseif ($_SESSION['Type_User'] == 2) {
					header("Location: ../panelAdmin.php");
				}
			} else {
				header("Location: ../index.php");
		}
	}
	if (empty($_SESSION)) {
  		header("Location: ../index.php");
	}
?>
