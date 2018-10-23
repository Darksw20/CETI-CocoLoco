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
        $amountProd = '0';
        $file = $_FILES['imagProd'];
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileError = $file['error'];
        $fileTemp = $file['tmp_name'];
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
            if($fileError == 0) {
                if($fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' || $fileType == 'image/gif') {
                    $extencion = "_".str_replace("/",".",$fileType); //Remplazar la / por . para la extencion
                    $nombreimg = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                    $fileDestiny = "images/".$nombreimg.$extencion;
                    $fileDestiny = mysqli_real_escape_string($con, $fileDestiny);

                    $confirmacion = move_uploaded_file($fileTemp, $fileDestiny);

                    if($confirmacion == 1) {
                        $sqlP = "INSERT INTO Stocktaking VALUES(NULL, '$nameProd', '$amountProd', '$priceProd', '$descriptProd', '$catProd', '$subcatProd', '$fileDestiny', '$provProd')";
                        $sentencia = $con->prepare($sqlP);
                        $sentencia->execute();
                        if($sentencia) {
                            echo "<div class='alert alert-success'>Producto ingresado correctamente</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Error! El producto ya existe.</div>Error! No se pudo almacenar la imagen en la base de datos.";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Error! El producto ya existe.</div>Imagen no copiada al servidor, existe algun error";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Error! El producto ya existe.</div>Error! No es un tipo de imagen valida o no es una imagen.";
                }
            } else {
                echo "<div class='alert alert-danger'>Error! La imagen es invalido, tiene algun error o el tamaño excede el limite.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Error! El producto ya existe.</div>";
        }
    }
?>
