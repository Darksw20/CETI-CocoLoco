<?php
 //error_reporting(0);
 include('conexion_bd.php');
 require_once('lib/nusoap.php');
 $cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

 $parametros = array();

 $resultado = $cliente->call('fetchIndex', $parametros);
 //$query = "SELECT * FROM Stocktaking ORDER BY ID DESC LIMIT 0, 12 ";
 //$result = mysqli_query($con, $query);

  $iterador = 0;

  while($iterador < 12) {

  echo '

      <div class="col-md-3">
        <figure class="card card-product">
          <div class="img-wrap"><img src="data:image/jpeg;base64,'.$resultado['return'][$iterador]['image'].'"></div>
          <figcaption class="info-wrap">
            <h6 class="title "><a href="#">'.$resultado['return'][$iterador]['productName'].'</a></h6>
            <div class="price-wrap">
              <span class="price-new">$'.$resultado['return'][$iterador]['rate'].'</span>
            </div>
            <select class="form-control" id="quantity'.$resultado['return'][$iterador]['id'].'" name="quantity" required>
              <option value="">Elige la cantidad</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
            	<input type="hidden" name="hidden_name" id="name'.$resultado['return'][$iterador]['id'].'" value="'.$resultado['return'][$iterador]['productName'].'" />
            	<input type="hidden" name="hidden_price" id="price'.$resultado['return'][$iterador]['id'].'" value="'.$resultado['return'][$iterador]['rate'].'" />
            	<input type="button" name="add_to_cart" id="'.$resultado['return'][$iterador]['id'].'" style="margin-top:5px;" class="btn btn-primary form-control add_to_cart" value="Añadir al carrito" />
          </figcaption>
        </figure>
      </div>

  ';

  $iterador ++;
}
?>
