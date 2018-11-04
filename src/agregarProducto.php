<?php
    require_once('conexion_bd.php');

    /**
    * Función para agregar producto;
    */
    if (!empty($_POST['nameProd'])) {
        $nameProd = $con -> real_escape_string($_POST['nameProd']);
        $priceProd = $con -> real_escape_string($_POST['priceProd']);
        $catProd = $con -> real_escape_string($_POST['catProd']);
        $subcatProd = $con -> real_escape_string($_POST['subcatProd']);
        $descriptProd = $con -> real_escape_string($_POST['descriptProd']);
        $provProd = $con -> real_escape_string($_POST['provProd']);
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $amountProd = '0';
        $error = 0;

        $sqlID = "SELECT Product_Name FROM Stocktaking ORDER BY Product_Name";
        $check = $con->query($sqlID);
        if(mysqli_num_rows($check) > 0) {
            while($fila = $check->fetch_assoc()) {
                $prodName = $fila['Product_Name'];
                if($prodName == $nameProd) {
                    $error = 1;
                    break;
                }
            }
        }

        if($error != 1)  {
            $sqlP = "INSERT INTO Stocktaking (ID, Product_Name, Lot, Rate, Product_Description, Class, SubClass, User_User_Name, Image) VALUES('', '$nameProd', '$amountProd', '$priceProd', '$descriptProd', '$catProd', '$subcatProd', '$provProd', '$file')";
            $sentencia = mysqli_query($con, $sqlP) or die(mysqli_error($con));
            if($sentencia) {
                echo "<div class='alert alert-success'>Producto ingresado correctamente</div>";
            } else {
                echo "<div class='alert alert-danger'>No se pudo almacenar la imagen en la base de datos.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>El producto ya existe.</div>";
        }
    }
?>
