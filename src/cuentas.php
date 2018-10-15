<?php
    function cuentas($con) {
        $sql = "SELECT COUNT(t.Folio) AS TOTALPROD, SUM(t.Amount) AS TOTAL, t.Stocktaking_ID, s.ID, s.Product_Name FROM Transaction AS t INNER JOIN Stocktaking AS s ON t.Stocktaking_ID = s.ID";

        $resultado = $con->query($sql);
        if (mysqli_num_rows($resultado) > 0) {
            $fila = $resultado->fetch_assoc();
            echo "
                <div class='col'>
                    <h6>Productos vendidos</h6>
                    <hr>
                    <h5 class='text-success'>
                        <i class='fas fa-exchange-alt fa-lg'></i> ".$fila['TOTALPROD']."
                    </h5>
                </div>
                <div class='col'>
                    <h6>Ingreso total</h6>
                    <hr>
                    <h5 class='text-success'>
                        <i class='fas fa-dollar-sign fa-lg'></i> ".$fila['TOTAL'].".00 MXN
                    </h5>
                </div>
            ";
        }
    }
?>