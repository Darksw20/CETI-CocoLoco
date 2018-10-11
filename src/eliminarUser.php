<?php
    include('conexion_bd.php');

    if (!empty($_POST['buscarProveedor'])) {
        if (!empty($delProv = $con->real_escape_string($_POST['buscarProveedor']))) {
            $sql = "SELECT * FROM user WHERE User_Name LIKE '%".$delProv."%' AND Type_User = '1'";
            $resultado = $con->query($sql);
            if (mysqli_num_rows($resultado) > 0) {
                echo "
                    <table class='table table-hover table-bordered'>
                        <thead class='thead-light'>
                            <tr>
                                <th scope='col'>Nombre de usuario</th>
                                <th scope='col'>Correo</th>
                                <th scope='col'>Tipo de usuario</th>
                                <th scope='col'>Nombre</th>
                                <th scope='col'>Apellido</th>
                                <th scope='col'>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                ";
                        while ($fila = $resultado->fetch_assoc()) {
                            $filaUser = "Proveedor (".$fila['Type_User'].")";
                            
                            echo "
                                    <tr data-toggle='modal'>
                                        <td>".$fila['User_Name']."</td>
                                        <td>".$fila['Mail']."</td>
                                        <td>".$filaUser."</td>
                                        <td>".$fila['Name']."</td>
                                        <td>".$fila['Last_Name']."</td>
                                        <td><button type='submit' name='borrarProv' class='btn btn-danger' id='btnDel' onclick='btnDelProv()' value='".$fila['User_Name']."'><i class='fas fa-trash-alt'></i></button></td>
                                    </tr>
                            ";
                        }
                echo "
                        </tbody>
                    </table>
                ";
            } else {
                echo "No se encontraron coincidencias.";
            }
        } else {
            echo "Por favor introduce algún nombre de una empresa.";
        }
    } elseif (!empty($_POST['buscarUser'])) {
        if (!empty($delUser = $con->real_escape_string($_POST['buscarUser']))) {
            $sql = "SELECT * FROM user WHERE User_Name LIKE '%".$delUser."%' AND Type_User = '0'";
            $resultado = $con->query($sql);
            if (mysqli_num_rows($resultado) > 0) {
                echo "
                    <table class='table table-hover table-bordered'>
                        <thead class='thead-light'>
                            <tr>
                                <th scope='col'>Nombre de usuario</th>
                                <th scope='col'>Correo</th>
                                <th scope='col'>Tipo de usuario</th>
                                <th scope='col'>Nombre</th>
                                <th scope='col'>Apellido</th>
                                <th scope='col'>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                ";
                        while ($fila = $resultado->fetch_assoc()) {
                            $filaUser = "Usuario (".$fila['Type_User'].")";
                            
                            echo "
                                    <tr data-toggle='modal'>
                                        <td>".$fila['User_Name']."</td>
                                        <td>".$fila['Mail']."</td>
                                        <td>".$filaUser."</td>
                                        <td>".$fila['Name']."</td>
                                        <td>".$fila['Last_Name']."</td>
                                        <td><button type='button' name='borrarUser' class='btn btn-sm btn-danger' id='btnDel' onclick='btnDelUser()' value='".$fila['User_Name']."'><i class='fas fa-trash-alt'></i></button></td>
                                    </tr>
                            ";
                        }
                echo "
                        </tbody>
                    </table>
                ";
            } else {
                echo "No se encontraron coincidencias.";
            }
        } else {
            echo "Por favor introduce algún nombre de un usuario.";
        }
    }

    if (!empty($_POST['btnDel'])) {
        if (!empty($btnDel = $_POST['btnDel'])) {
        $sql = mysqli_query($con, "DELETE FROM user WHERE User_Name = '$btnDel'");
            if ($sql) {
                echo "Usuario eliminado.";
            } else {
                echo "No se pudo eliminar al usuario.";
            }
        }
    }
?>