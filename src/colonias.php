<?php
    //include('conexion_bd.php');

    function colonia($con) {
        $sql = "SELECT * FROM Neighborhood ORDER BY Name ASC";
        $res = $con->query($sql);
        //echo "<select class='form-control' id='formSelect0' name='colonia' required>";
        if (mysqli_num_rows($res) > 0) {
            while ($dom = $res->fetch_assoc()) {
            echo "
                <option value='".$dom['Code']."'>".$dom['Name']."</option>
            ";
            }
        }
        //echo "</select>";
    }
?>