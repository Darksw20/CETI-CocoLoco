<?php

include('conexion_bd.php');

$categoria = $_POST["categoria"];
require_once('../lib/nusoap.php');

$cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

$parametros = array('CocoJAXWS' => '',
                    'Class' => $categoria,
                    );

$resultado = $cliente->call('selectCategoria', $parametros);

print_r($resultado);
//$query = "SELECT * FROM Stocktaking WHERE Class = "$categoria"";

//$resultado = mysqli_query($con, $query);

//while ($row = mysqli_fetch_array($resultado)) {
  echo '

      <div class="col-md-3">
        <figure class="card card-product">
          <div class="img-wrap"><img src="'.$row["Image"].'"></div>
          <figcaption class="info-wrap">
            <h6 class="title "><a href="#">'.$row["Product_Name"].'</a></h6>
            <div class="price-wrap">
              <span class="price-new">$'.$row["Rate"].'</span>
            </div>
            <select class="form-control" id="quantity'.$row["ID"].'" name="quantity" required>
              <option value="">Elige la cantidad</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
            	<input type="hidden" name="hidden_name" id="name'.$row["ID"].'" value="'.$row["Product_Name"].'" />
            	<input type="hidden" name="hidden_price" id="price'.$row["ID"].'" value="'.$row["Rate"].'" />
            	<input type="button" name="add_to_cart" id="'.$row["ID"].'" style="margin-top:5px;" class="btn btn-primary form-control add_to_cart" value="Añadir al carrito" />
          </figcaption>
        </figure>
      </div>

  ';
//}

?>
