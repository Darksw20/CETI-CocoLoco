<?php
	require('conexion_bd.php');
	require('../lib/nusoap.php');

	$correo = $con->real_escape_string($_POST['email']);
	$pass = $con->real_escape_string($_POST['password']);
		if (!empty($correo) && !empty($pass)) {
			//$pass = sha1($pass);

            $cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

            $parametros = array('CocoJAXWS' => '',
								'MailUser' => $correo,
								'Password' => $pass,
                                );
            $resultado = $cliente->call('procesLgn', $parametros);

            var_dump($resultado);
			//$consulta = "SELECT * FROM User WHERE Mail = '$correo' AND Password = '$pass' LIMIT 1";
			//$resultado = $con->query($consulta);
				session_start();
				$id_de_sesion = session_id();

				if ($resultado['return'][0]) {
					$_SESSION['User_Name'] = $resultado['return'][0]['userName'];
					$_SESSION['Password'] = $resultado['return'][0]['password'];
					$_SESSION['Mail'] = $resultado['return'][0]['mail'];
					$_SESSION['Amount'] = $resultado['return'][0]['amount'];
					$_SESSION['Type_User'] = $resultado['return'][0]['typeUser'];
					$_SESSION['Name'] = $resultado['return'][0]['name'];
					$_SESSION['Last_Name'] = $resultado['return'][0]['lastName'];
					$_SESSION['Phone_Number'] = $resultado['return'][0]['phoneNumber'];
					$_SESSION['Adress'] = $resultado['return'][0]['adress'];
					$_SESSION['Neighborhood_Code'] = $resultado['return'][0]['neighborhoodCode']['code'];
					$_SESSION['Id_Session'] = $id_de_sesion; //numero de la variable de sesion
				}else {
					$_SESSION['User_Name'] = $resultado['return']['userName'];
					$_SESSION['Password'] = $resultado['return']['password'];
					$_SESSION['Mail'] = $resultado['return']['mail'];
					$_SESSION['Amount'] = $resultado['return']['amount'];
					$_SESSION['Type_User'] = $resultado['return']['typeUser'];
					$_SESSION['Name'] = $resultado['return']['name'];
					$_SESSION['Last_Name'] = $resultado['return']['lastName'];
					$_SESSION['Phone_Number'] = $resultado['return']['phoneNumber'];
					$_SESSION['Adress'] = $resultado['return']['adress'];
					$_SESSION['Neighborhood_Code'] = $resultado['return']['neighborhoodCode']['code'];
					$_SESSION['Id_Session'] = $id_de_sesion; //numero de la variable de sesion
				}

				$parametrosSession = array(
							'CocoJAXWS' => '',
							'User_Name' => $_SESSION['User_Name'],
							'Password' => $_SESSION['Password'],
							'Mail' => $_SESSION['Mail'],
							'Amount' => $_SESSION['Amount'],
							'Type_User' => $_SESSION['Type_User'],
							'Name' => $_SESSION['Name'],
							'Last_Name' => $_SESSION['Last_Name'],
							'Phone_Number' => $_SESSION['Phone_Number'],
							'Adress' => $_SESSION['Adress'],
							'Neighborhood_Code' => $_SESSION['Neighborhood_Code'],
							'Session' => $_SESSION['Id_Session']

				);

				$resultadoUpdateSesion = $cliente->call('updateSession', $parametrosSession);

				var_dump($resultadoUpdateSesion);


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
				header('Location: ../index.php ');
			}
	if (empty($_SESSION)) {
  		header('Location: ../index.php');
	}
?>
