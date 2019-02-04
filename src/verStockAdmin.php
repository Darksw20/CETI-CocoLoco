<?php
    include('conexion_bd.php');
    $output = '';

    if (!empty($_POST['verStock'])) {
        if ($buscar = $con->real_escape_string($_POST['verStock'])) {
            /*require_once('../lib/nusoap.php');

            $cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

            $parametros = array('CocoJAXWS' => '',
                                'Product_Name' => $buscar,
                                );

            $resultado = $cliente->call('verStockAdmin', $parametros);

            print_r($resultado);*/
            $sql = "SELECT * FROM Stocktaking WHERE Product_Name LIKE '%".$buscar."%'";
            $resultado = $con->query($sql);

            $output .= '
                    <div class="table-responsive">
                         <table class="table table-bordered">
                              <tr>
                                   <th width="10%">ID</th>
                                   <th width="40%">Nombre de producto</th>
                                   <th width="40%">Cantidad</th>
                                   <th width="40%">Precio</th>
                                   <th width="40%">Product_Description</th>
                                   <th width="40%">Categroría</th>
                                   <th width="40%">Proveedor</th>
                              </tr>';

            if (mysqli_num_rows($resultado) > 0) {
                while ($row = $resultado->fetch_assoc()) {
                      $output .='
                              <tr>
                              <td>'.$row["ID"].'</td>
                                 <td class="Product_Name" data-id1="'.$row["ID"].'" contenteditable>'.$row["Product_Name"].'</td>
                                 <td class="Lot" data-id2="'.$row["ID"].'" contenteditable>'.$row["Lot"].'</td>
                                 <td class="Rate" data-id3="'.$row["ID"].'" contenteditable>'.$row["Rate"].'</td>
                                 <td class="Product_Description" data-id4="'.$row["ID"].'" contenteditable>'.$row["Product_Description"].'</td>
                                 <td class="Class" data-id5="'.$row["ID"].'" contenteditable>'.$row["Class"].'</td>
                                 <td class="User_User_Name" data-id6="'.$row["ID"].'" contenteditable>'.$row["User_User_Name"].'</td>
                              </tr>';
                }
            }
            $output .= '</table>
                      </div>';
            echo $output;
        } else {
            echo "Por favor, introduce un ID de un producto.";
        }
    }
?>
