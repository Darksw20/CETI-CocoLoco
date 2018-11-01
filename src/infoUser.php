<?php
    include('conexion_bd.php');

    function infoUser($con) {
        $user = $_SESSION['User_Name'];
        $sql = "SELECT u.User_name, u.Password, u.Mail, u.Amount, u.Name, u.Last_Name, u.Phone_Number, u.Adress, u.Neighborhood_Code, n.Code AS Code, n.Name AS nomb, n.PC AS PC FROM User AS u INNER JOIN Neighborhood AS n ON u.Neighborhood_Code = n.Code WHERE User_Name = '$user'";
        $res = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($res);
        if ($rows > 0) {
            while ($fila = mysqli_fetch_array($res)) {
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
                        <input type='number' class='form-control' name='tel' id='tel' value='".$fila['Phone_Number']."'>
                      </div>
                    </div>
                    <h6 class='text-primary'>Domicilio</h6>
                    <hr>
                    <div class='form-row espacioHeightsm'>
                      <div class='col-md-6 mb-4'>
                        <label for='street'>Calle</label>
                        <input type='text' class='form-control' id='street' name='calle' value='".$fila['Adress']."'>
                      </div>
                      <div class='col-md-6 mb-4'>
                        <label for='formSelect0'>Colonia</label>
                        <select class='form-control' id='formSelect0' name='colonia' required>
                            <option value='".$fila['Code']."'>".$fila['nomb']."</option>
                            <option disable></option>
                ";
                          colonia($con);
                echo "
                        </select>
                      </div>
                    </div>
                    <input type='hidden' value='".$fila['Code']."' name='code'>
                    <button type='submit' class='btn btn-primary' name='user' value='".$user."'>Modificar</button>
                  </form>
                ";
            }
        }
    }

    function infoPass($con){
      $user = $_SESSION['User_Name'];
      echo "
      <form action='src/modificarPass.php' id='form_modPass' method='post'>
          <div class='form-row espacioHeightsm'>
            <div class='col-md-6 -mb-3'>
              <label for='passOld'>Contraseña antigua:</label>
              <input type='password' class='form-control' name='passOld' id='passOld' minlength='6' maxlength='15' required>
            </div>
          </div>
          <h6 class='text-primary'>Escribe tu nueva contraseña</h6>
          <hr>
          <div class='form-row espacioHeightsm'>
            <div class='col'>
              <label for='newPwd'>Contraseña:</label>
              <input type='password' class='form-control' name='newPwd' id='newPwd' minlength='6' maxlength='15' required>
            </div>
            <div class='col'>
              <label for='newPwd2'>Repertir contraseña:</label>
              <input type='password' class='form-control' name='newPwd2' id='newPwd2' minlength='6' maxlength='15'onkeyup='compararPass()' required>
            </div>
          </div>
          <input type='hidden' name='user' id='user' value='".$user."' />
          <span id='erro1'></span><br><br>
            <span id='erro2'></span>
          <button type='submit' class='btn btn-primary'>Modificar</button>
        </form>";
    }

    function infoSS($con){
      $user = $_SESSION['User_Name'];
        $query = "SELECT Amount FROM User Where User_name = '$user'";
        $res = mysqli_query($con, $query);
        echo mysqli_error($con);
        while ($fila = mysqli_fetch_array($res)) {
          echo "<h4 id='imprimirSaldo' class='text-success'>$".$fila['Amount']."</h4>";
        }
    }
?>
