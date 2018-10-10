<?php
 $connect = mysqli_connect("localhost", "root", "", "testing");
 $query = "SELECT * FROM tbl_user ORDER BY idProducto DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]." ";
 $result = mysqli_query($connect, $query);

 while($row = mysqli_fetch_array($result))
 {
  echo '

      <div class="col-md-3">
        <figure class="card card-product">
          <div class="img-wrap">imagen xd</div>
          <figcaption class="info-wrap">
            <h6 class="title "><a href="#">'.$row["nomProd"].'</a></h6>
            <div class="price-wrap">
              <span class="price-new">$'.$row["precio"].'</span>
            </div>
          </figcaption>
        </figure>
      </div>

  ';
 }
?>
