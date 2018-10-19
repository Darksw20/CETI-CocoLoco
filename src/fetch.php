<?php
 include('conexion_bd.php');
 $query = "SELECT * FROM stocktaking ORDER BY ID DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]." ";
 $result = mysqli_query($con, $query);

 while($row = mysqli_fetch_array($result)){
  echo '

      <div class="col-md-3">
        <figure class="card card-product">
          <div class="img-wrap"><img src="'.$row["Image"].'"></div>
          <figcaption class="info-wrap">
            <h6 class="title "><a href="#">'.$row["Product_Name"].'</a></h6>
            <div class="price-wrap">
              <span class="price-new">$'.$row["Rate"].'</span>
            </div>
            <input type="text" name="quantity" id="quantity' . $row["ID"] .'" class="form-control" value="1" />
            	<input type="hidden" name="hidden_name" id="name'.$row["ID"].'" value="'.$row["Product_Name"].'" />
            	<input type="hidden" name="hidden_price" id="price'.$row["ID"].'" value="'.$row["Rate"].'" />
            	<input type="button" name="add_to_cart" id="'.$row["ID"].'" style="margin-top:5px;" class="btn btn-primary form-control add_to_cart" value="Añadir al carrito" />
          </figcaption>
        </figure>
      </div>

  ';
 }
?>
