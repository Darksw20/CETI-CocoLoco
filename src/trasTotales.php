<?php
    include('conexion_bd.php');

    $verTransT = $con->real_escape_string($_POST['verTransT']);

    $sql = "SELECT t.Stocktaking_ID, SUM(t.Amount) AS TOTAL, s.ID, s.User_User_Name FROM Transaction AS t INNER JOIN Stocktaking AS s ON t.Stocktaking_ID = s.ID WHERE s.User_User_Name LIKE '%".$verTransT."%';";
    $resultado = $con->query($sql);
    if (mysqli_num_rows($resultado) > 0) {
        echo "
            <table class='table table-bordered'>
                <thead class='thead-light'>
                    <tr>
                        <th scope='col'>Proveedor</th>
                        <th scope='col'>Ingreso Gnerado</th>
                    </tr>
                </thead>
                <tbody>
        ";
        while ($fila = $resultado->fetch_assoc()) {                  
            echo "
                    <tr>
                        <td>".$fila['User_User_Name']."</td>
                        <td class='text-success'>$ ".$fila['TOTAL'].".00</td>
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
?>