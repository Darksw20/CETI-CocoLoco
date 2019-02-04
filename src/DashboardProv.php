  <?php
  include 'conexion_bd.php';

  //Ventas del día
  function VentProv($con, $proveedor){
    date_default_timezone_set('america/mexico_city');
    $fechahoy = date("Y-m-d");
    $fecham1 = $fechahoy." 00:00:00";
    $fecham2 = $fechahoy." 23:59:59";
    $dato1 = mysqli_query($con, "SELECT IFNULL(COUNT(Rate), '0') FROM Transaction AS A INNER JOIN Stocktaking AS B ON A.stocktaking_ID = B.ID WHERE B.User_User_Name = '$proveedor' AND A.Date BETWEEN '$fecham1' AND '$fecham2'");
    while($row = mysqli_fetch_array($dato1)){
      $numeral = $row[0];
    }
    echo $numeral;
    }

  //Ganacias del día
  function GanaHoyProv($con, $proveedor){
    date_default_timezone_set('america/mexico_city');
    $fechahoy = date("Y-m-d");
    $fecham1 = $fechahoy." 00:00:00";
    $fecham2 = $fechahoy." 23:59:59";
    $dato1 = mysqli_query($con, "SELECT IFNULL(SUM(Rate), '0') FROM Transaction AS A INNER JOIN Stocktaking AS B ON A.stocktaking_ID = B.ID WHERE B.User_User_Name = '$proveedor' AND A.Date BETWEEN '$fecham1' AND '$fecham2'");
    while($row = mysqli_fetch_array($dato1)){
      $numeral = $row[0];
    }
  echo $numeral;
  }

  //Ganancias de la semana
  function VentSemProv($con, $proveedor){
    date_default_timezone_set('america/mexico_city');
    $fechahoy = date("Y-m-d");
    $fecham1 = date("Y-m-d",strtotime($fechahoy."- 1 days")); 
    $fecham1 = $fecham1." 00:00:00";
    $fecham2 = $fechahoy." 23:59:59";
    $dato1 = mysqli_query($con, "SELECT IFNULL(SUM(Rate), '0') FROM Transaction AS A INNER JOIN Stocktaking AS B ON A.stocktaking_ID = B.ID WHERE B.User_User_Name = '$proveedor' AND A.Date BETWEEN '$fecham1' AND '$fecham2'");
    while($row = mysqli_fetch_array($dato1)){
      $numeral = $row[0];
    }
    echo $numeral;
    }

  //Producto más vendido
  function TopSeller($con, $proveedor){
    date_default_timezone_set('america/mexico_city');
    $fechahoy = date("Y-m-d");
    $fecham1 = date("Y-m-d",strtotime($fechahoy."- 1 days")); 
    $fecham1 = $fecham1." 00:00:00";
    $fecham2 = $fechahoy." 23:59:59";
    $dato1 = mysqli_query($con, "SELECT Product_Name FROM Transaction AS A INNER JOIN Stocktaking AS B ON A.Stocktaking_ID = B.ID WHERE B.User_User_Name = '$proveedor' AND A.Date BETWEEN '$fecham1' AND '$fecham2' GROUP BY Product_Name
    HAVING COUNT(Stocktaking_ID) = ( SELECT MAX(contador) max_contador
    FROM ( SELECT Stocktaking_ID, COUNT(*) contador
    FROM Transaction GROUP BY Stocktaking_ID) T) ORDER BY Product_Name ASC LIMIT 1");
      while($row = mysqli_fetch_array($dato1)){
        $numeral = $row[0];
      }
  if(!empty($numeral)){
    echo $numeral;
    }else{
      echo "No hay producto mas vendido"; 
    }
  }
  ?>    
