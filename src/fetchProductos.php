<?php
 $connect = mysqli_connect("localhost", "root", "", "invoice");
 $query = "SELECT * FROM stocktaking ORDER BY ID DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]." ";
 $result = mysqli_query($connect, $query);

 while($row = mysqli_fetch_array($result))
 {
  echo '

      <div class="col-md-3">
        <figure class="card card-product">
          <div class="img-wrap">imagen xd</div>
          <figcaption class="info-wrap">
            <h6 class="title "><a href="#">'.$row["Product_Name"].'</a></h6>
            <div class="price-wrap">
              <span class="price-new">$'.$row["Rate"].'</span>
            </div>
          </figcaption>
        </figure>
      </div>

  ';
 }
?>
