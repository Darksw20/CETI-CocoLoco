<?php
    include('conexion_bd.php');

    $sql = "SELECT * FROM transaction";
    $resultado = $con->query($sql);
    if (mysqli_num_rows($resultado) > 0) {
        while ($fila = $resultado->fetch_assoc()) {                  
            echo "
                <thead class='thead-light'>
                    <tr>
                        <th scope='col'>Folio</th>
                        <th scope='col'>Fecha</th>
                        <th scope='col'>Proveedor</th>
                        <th scope='col'>Producto</th>
                        <th scope='col'>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>".$fila['Folio']."</td>
                        <td>".$fila['Date']."</td>
                        <td>".$fila['User_User_Name']."</td>
                        <td>".$fila['Stocktaking_ID']."</td>
                    </tr>
                </tbody>
            ";
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