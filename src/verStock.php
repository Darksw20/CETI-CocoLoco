<?php
    include('conexion_bd.php');

    if (!empty($_POST['verStock'])) {
        if ($buscar = $con->real_escape_string($_POST['verStock'])) {
            $sql = "SELECT * FROM stocktaking WHERE Product_Name LIKE '%".$buscar."%'";

            $resultado = $con->query($sql);
            if (mysqli_num_rows($resultado) > 0) {
                while ($fila = $resultado->fetch_assoc()) {                  
                    echo "
                            <thead>
                                <tr>
                                    <th>ID producto</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Descripcion</th>
                                    <th>Categoría</th>
                                    <th>Imágen</th>
                                    <th>Proveedor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>".$fila['ID']."</td>
                                    <td>".$fila['Product_Name']."</td>
                                    <td>".$fila['Lot']."</td>
                                    <td>".$fila['Rate']."</td>
                                    <td>".$fila['Product_Descript']."</td>
                                    <td>".$fila['Class']."</td>
                                    <td>".$fila['Image']."</td>
                                    <td>".$fila['User_User_Name']."</td>
                                </tr>
                            </tbody>
                    ";
                }
            } else {
                echo "No se encontraron coincidencias.";
            }
        } else {
            echo "Por favor, introduce un ID de un producto.";
        }
    }
?>
<script>
    //tabla inventario
    $(document).ready(function(){
        $('#editable_table').Tabledit({
        url: 'actualizarStock.php',
        columns: {
            identifier:[0, 'ID'],
            editable:[[2, 'Lot']]
        },
        editButton: false,
        deleteButton: false,
        hideIdentifier: true,
        restoreButton: false,
        onSuccess:function(data, textStatus, jqXHR) {
            if(data.action == 'delete') {
                $('#'+data.ID).remove();
            }
        }
        });
    });
    //tabla inventario
</script>