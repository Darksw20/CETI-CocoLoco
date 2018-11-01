<?php
    include('config.php');

    if (!empty($_POST['buscarUser'])) {
        if (!empty($delUser = $con->real_escape_string($_POST['buscarUser']))) {
            $sql = "SELECT * FROM conferencia WHERE tema LIKE '%".$delUser."%'";
            $resultado = $con->query($sql);
            if (mysqli_num_rows($resultado) > 0) {
                echo "
                    <table class='table table-hover table-bordered'>
                        <thead class='thead-light'>
                            <tr>
                                <th scope='col'>Conferencia</th>
                                <th scope='col'>Expositor</th>
                                <th scope='col'>Fecha</th>
                                <th scope='col'>Horario</th>
                                <th scope='col'>Capacidad</th>
                                <th scope='col'>Registrar</th>
                            </tr>
                        </thead>
                        <tbody>
                ";
                        while ($fila = $resultado->fetch_assoc()) {
                            //$filaUser = "Usuario (".$fila['Type_User'].")";

                            echo "
                                <tr data-toggle='modal'>
                                    <td>".$fila['tema']."</td>
                                    <td>".$fila['expositor']."</td>
                                    <td>".$fila['fecha']."</td>
                                    <td>".$fila['horario']."</td>
                                    <td>".$fila['capacidad']."</td>
                                    <td>
                                    <form action='src/registro_conferencia.php' method='post'>
                                        <input type='hidden' name='exposicion' value='".$fila['id_conferencia']."'>
                                        <button type='submit' name='borrarProv' class='btn btn-success' value='".$fila['id_conferencia']."'>Registrar</button></td>
                                    </form>
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
            $sql = "DELETE FROM User WHERE User_Name = '$btnDel'";
            $sentencia = $con->prepare($sql);
            $sentencia->execute();
            $sentencia->close();
            if ($sql) {
                echo "Usuario eliminado.";
            } else {
                echo "No se pudo eliminar el usuario.";
            }
        }
    }
?>
