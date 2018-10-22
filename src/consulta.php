<?php
/////// CONEXIÓN A LA BASE DE DATOS /////////
include('conexion_bd.php');

//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$query="SELECT * FROM Stocktaking ORDER BY ID";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['stocktaking']))
{
	$q=$con->real_escape_string($_POST['stocktaking']);
	$query="SELECT * FROM Stocktaking WHERE
		ID LIKE '%".$q."%' OR
		Product_Name LIKE '%".$q."%' OR
		Product_Description LIKE '%".$q."%' OR
		SubClass LIKE '%".$q."%' OR
		Class LIKE '%".$q."%'";
}
///////////////////// Esta funcion se encarga de hacer la consulta e imprimirla /////////////////////////////////
$buscarProducto=$con->query($query);
if ($buscarProducto->num_rows > 0){

	while($row= $buscarProducto->fetch_assoc()){
		$tabla.=
		'<div class="col-md-3">
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
	}

} else{ //Si no se encuentran coincidencias este mensaje aparece
		$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
	}


echo $tabla;//impresion de table
?>
