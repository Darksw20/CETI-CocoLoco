<?php
    //action.php
    include('conexion_bd.php');

    $input = filter_input_array(INPUT_POST);
    $precio = mysqli_real_escape_string($con, $input["precio"]);

    if($input["action"] === 'edit'){
        $query = "UPDATE stocktaking SET Lot = '".$precio."' WHERE ID = '".$input['idProducto']."'";
        mysqli_query($con, $query);
    }
    echo json_encode($input);
?>
