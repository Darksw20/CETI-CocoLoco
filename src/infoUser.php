<?php
    include('conexion_bd.php');

    function infoUser($con, $user) {        
        //$user = $_POST['User_Name'];
        $sql = "SELECT u.User_name, u.Password, u.Mail, u.Amount, u.Name, u.Last_Name, u.Phone_Number, u.Adress_Code, a.Code, a.Street AS St, a.Number AS StNum, a.Neighborhood_Code, n.Code AS Code, n.Name AS Col, n.PC AS PC FROM user AS u INNER JOIN adress AS a INNER JOIN neighborhood AS n ON u.Adress_Code = a.Code AND a.Neighborhood_Code = n.Code WHERE User_Name = '$user'";
        $res = $con->query($sql);
        if (mysqli_num_rows($res) > 0) {
            while ($fila = $res->fetch_assoc()) {                  
                echo "
                <form action='src/modificarUsuario.php' method='post'>
                    <h6 class='text-primary'>Datos personales</h6>
                    <hr>
                    <div class='form-row espacioHeightsm'>
                      <div class='col'>
                        <label for='nombre'>Nombre(s):</label>
                        <input type='text' class='form-control' name='nombreUsuario' id='nombre' value='".$fila['Name']."'>
                      </div>
                      <div class='col'>
                        <label for='apellidoMod'>Apellido:</label>
                        <input type='text' class='form-control' name='apellidoUsuario' id='apellidoMod' value='".$fila['Last_Name']."'>
                      </div>
                      <div class='col'>
                        <label for='tel'>Telefono:</label>
                        <input type='text' class='form-control' name='telefono' id='tel' value='".$fila['Phone_Number']."'>
                      </div>
                    </div>
                    <h6 class='text-primary'>Domicilio</h6>
                    <hr>
                    <div class='form-row espacioHeightsm'>
                      <div class='col-md-4 mb-2'>
                        <label for='street'>Calle</label>
                        <input type='text' class='form-control' id='street' name='calle' value='".$fila['St']."'>
                      </div>
                      <div class='col-md-2 mb-2'>
                        <label for='numCalle'>Numero</label>
                        <input type='text' class='form-control' id='numCalle' name='numeroCalle' value='".$fila['StNum']."'>
                      </div>
                      <div class='col-md-4 mb-2'>
                            <label for='formSelect0'>Colonia</label>
                            <select class='form-control' id='formSelect0' name='colonia' required>
                                <option value='".$fila['Code']."'>".$fila['Col']."</option>
                                <option disable></option>
                ";
                          $sql2 = "SELECT * FROM neighborhood";
                          $res2 = $con->query($sql2);
                          if (mysqli_num_rows($res2) > 0) {
                              while ($dom = $res2->fetch_assoc()) {
                                echo "
                                  <option value='".$dom['Code']."'>".$dom['Name']."</option>
                                ";  
                              }
                          }
                echo "
                        
                            </select>
                        </div>
                        <div class='col-md-2 mb-2'>
                            <label for='cp'>Código postal</label>
                            <input type='text' class='form-control' id='cp' name='codigoPostal' value='".$fila['PC']."'>
                        </div>
                    </div>
                    <button type='submit' class='btn btn-primary' name='button'>Modificar</button>
                  </form>
                </div>
                
                <div id='modPassword' class='container tab-pane'>
                  <form action='src/modificarContraseña.php' method='post'>
                    <div class='form-row espacioHeightsm'>
                      <div class='col-md-6 -mb-3'>
                        <label for='passOld'>Contraseña antigua:</label>
                        <input type='password' class='form-control' name='modPasswordOld' id='passOld'>
                      </div>
                    </div>
                    <h6 class='text-primary'>Escribe tu nueva contraseña</h6>
                    <hr>
                    <div class='form-row espacioHeightsm'>
                      <div class='col'>
                        <label for='newPwd'>Contraseña:</label>
                        <input type='password' class='form-control' name='contrasenaMod' id='newPwd'>
                      </div>
                      <div class='col'>
                        <label for='newPwd2'>Repertir contraseña:</label>
                        <input type='password' class='form-control' name='contraseMod2' id='newPwd2'>
                      </div>
                    </div>
                    <input type='hidden' name='user' value='".$user."' />
                    <button type='submit' class='btn btn-primary'>Modificar</button>
                  </form>
                ";
            }
        }
    }
?>