<?php
    require_once('conexion_bd.php');

    /**
    * Función para actualizar producto;
    */
    if (!empty($_POST['findProd'])) {
        if (!empty($id = $con->real_escape_string($_POST['findProd']))) {
            $sqlID = "SELECT * FROM stocktaking WHERE ID = '$id'";
            $check = $con->query($sqlID);
            if(mysqli_num_rows($check) > 0) {
                echo "
                    <table class='table table-hover table-bordered'>
                        <thead class='thead-light'>
                            <tr>
                                <th scope='col'>ID</th>
                                <th scope='col'>Nombre</th>
                                <th scope='col'>Precio</th>
                                <th scope='col'>Cantidad</th>
                                <th scope='col'>Descripción</th>
                                <th scope='col'>Categoria</th>
                                <th scope='col'>Subcategoria</th>
                                <th scope='col'>Imagen</th>
                                <th scope='col'>Provedor</th>
                            </tr>
                        </thead>
                        <tbody>
                ";
                        while ($fila = $check->fetch_assoc()) {                     
                            echo "
                                    <tr data-toggle='modal'>
                                        <td id='id_Prod' name='id_Prod'>".$fila['ID']."</td>
                                        <td><input type='text' class='form-control' id='name_Prod' placeholder='Nombre' value=".$fila['Product_Name']." name='name_Prod'></td>
                                        <td><input type='text' class='form-control' id='lot_Prod' placeholder='Precio' value=".$fila['Lot']." name='lot_Prod'></td>
                                        <td>".$fila['Rate']."</td>
                                        <td><input type='text' class='form-control' id='descript_Prod' placeholder='Descripción' value=".$fila['Product_Description']." name='descript_Prod'></td>
                                        <td><input type='text' class='form-control' id='class_Prod' placeholder='Categoria' value=".$fila['Class']." name='class_Prod'></td>
                                        <td><input type='text' class='form-control' id='subclass_Prod' placeholder='Subcategoria' value=".$fila['SubClass']." name='subclass_Prod'></td>
                                        <td>".$fila['Image']."
                                            <div class='col-md-3 mb-3'>
                                                <div class='input-file-container>
                                                    <form id='uploadimage' name='uploadimage' method='post' enctype='multipart/form-data'>
                                                        <input class='input-file' id='imagProd' type='file' style='width:5px' name='imagProd'>
                                                    </form>
                                                </div>
                                                <p class='file-return'></p>
                                            </div>
                                        </td>
                                        <td>".$fila['User_User_Name']."</td>
                                        <td><button type='submit' name='btnDelProduct' class='btn btn-update' id='btnUpProduct' onclick='btnUpProd()' value='".$fila['ID']."'><i class='fas fa-sync'></i></button></td>
                                    </tr>
                            ";
                        }
                echo "
                        </tbody>
                    </table>
                ";
            } else {
                echo "Error! El ID es invalido.";
            }
        } else {
            echo "Por favor ingresa el ID del producto a eliminar";
        }
    }

    if (!empty($_POST['btnUpProd'])) {
        if (!empty($idDelProd = $_POST['btnUpProd'])) {
            //Actualizar
            $idprod = $con -> real_escape_string($_POST['id_Prod']);
            $productName = $con -> real_escape_string($_POST['name_Prod']);
            $lot = $con -> real_escape_string($_POST['lot_Prod']);
            $productDescription = $con -> real_escape_string($_POST['descript_Prod']);
            $classVar = $con -> real_escape_string($_POST['class_Prod']);
            $subClassVar = $con -> real_escape_string($_POST['subclass_Prod']);
            $file = $_FILES['imagProd'];
            $fileName = $file['name'];
            $fileType = $file['type'];
            $fileError = $file['error'];
            $fileTemp = $file['tmp_name'];
            $sqlP = "DELETE Image FROM stocktaking WHERE ID = '$idprod'";
            if(!empty($productName) && !empty($lot) && !empty($productDescription) && !empty($classVar) && !empty($subClassVar)) {
                if($fileError == 0) {
                    if($fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' || $fileType == 'image/gif') {
                        $extencion = "_".str_replace("/",".",$fileType); //Remplazar la / por . para la extencion
                        $nombreimg = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                        $fileDestiny = '../images/'.$nombreimg.$extencion;
                        $fileDestiny = mysqli_real_escape_string($con, $fileDestiny);
                            
                        $confirmacion = move_uploaded_file($fileTemp, $fileDestiny);
        
                        if($confirmacion == 1) {
                            $sqlP = "UPDATE stocktaking SET Product_Name = '$productName', Lot = '$lot', Product_Description = '$productDescription', Class = '$classVar', SubClass = '$subClassVar' WHERE ID = '$idDelProd'";
                            $sentencia = $con->prepare($sqlP);
                            $sentencia->execute();
                            if ($sentencia) {
                                echo "Producto actualizado.";
                            } else {
                                echo "Error! No se pudo actualizar el producto.";
                            }
                            $sentencia->close();
                        } else {
                            echo "Imagen no copiada al servidor, existe algun error";
                        }
                    } else {
                        echo "Error! No es un tipo de imagen valida o no es una imagen.";
                    }
                } else {
                    echo "Error! La imagen es invalida o tiene algun error.";
                }
            } else {
                echo "Error! No dejes campos vacios";
            }
        }
    }

    /*css
    .btn-update {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }*/
?>