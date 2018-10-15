<?php     
    date_default_timezone_set('america/mexico_city'); //configuro el uso horario a trabajar
    $fechahoy = date("Y-m-d"); // obtengo la fecha de hoy
    $Sesion = 'Pedromaxor';
    $fecha7m = date("Y-m-d",strtotime($fechahoy."- 6 days")); //a la fecha hoy resto 6 dias
    $fecha7m1 = $fecha7m." 00:00:00";
    $fecha7m2 = $fecha7m." 23:59:59";
    //Consulta donde verifico si la suma llegara a ser nula agregale un 0, un inner join de
    //la tabla de ventas a producto buscando entre el inicio de un dia y el final todas la ganancias
    $Dato1=mysqli_query($con,"SELECT IFNULL(SUM(Rate),'0') FROM Transaction AS A INNER JOIN stocktaking AS B ON A.Stocktaking_ID=B.ID WHERE B.User_User_Name='$Sesion' AND A.Date BETWEEN '$fecha7m1' AND '$fecha7m2'");
    //echo "7 dias:".$fecha7m."|".$fecha7m1."|".$fecha7m2."<br>";
    $fecha6m = date("Y-m-d",strtotime($fechahoy."- 5 days")); //a la fecha hoy resto 5 dias
    $fecha6m1 = $fecha6m." 00:00:00"; //Concateno con la hora de inicio del dia
    $fecha6m2 = $fecha6m." 23:59:59"; //Concateno con la ultima hora del dia
    $Dato2=mysqli_query($con,"SELECT IFNULL(SUM(Rate),'0') FROM Transaction AS A INNER JOIN stocktaking AS B ON A.Stocktaking_ID=B.ID WHERE B.User_User_Name='$Sesion' AND A.Date BETWEEN '$fecha6m1' AND '$fecha6m2'");
    //echo "6 dias:".$fecha6m."|".$fecha6m1."|".$fecha6m2."<br>";
    $fecha5m = date("Y-m-d",strtotime($fechahoy."- 4 days")); //a la fecha hoy resto 4 dias
    $fecha5m1 = $fecha5m." 00:00:00";
    $fecha5m2 = $fecha5m." 23:59:59";
    $Dato3=mysqli_query($con,"SELECT IFNULL(SUM(Rate),'0') FROM Transaction AS A INNER JOIN stocktaking AS B ON A.Stocktaking_ID=B.ID WHERE B.User_User_Name='$Sesion' AND A.Date BETWEEN '$fecha5m1' AND '$fecha5m2'");
    //echo "5 dias:".$fecha5m."|".$fecha5m1."|".$fecha5m2."<br>";
    $fecha4m = date("Y-m-d",strtotime($fechahoy."- 3 days")); //a la fecha hoy resto 3 dias
    $fecha4m1 = $fecha4m." 00:00:00";
    $fecha4m2 = $fecha4m." 23:59:59";
    $Dato4=mysqli_query($con,"SELECT IFNULL(SUM(Rate),'0') FROM Transaction AS A INNER JOIN stocktaking AS B ON A.Stocktaking_ID=B.ID WHERE B.User_User_Name='$Sesion' AND A.Date BETWEEN '$fecha4m1' AND '$fecha4m2'");
    //echo "4 dias:".$fecha4m."|".$fecha4m1."|".$fecha4m2."<br>";
    $fecha3m = date("Y-m-d",strtotime($fechahoy."- 2 days")); //a la fecha hoy resto 2 dias
    $fecha3m1 = $fecha3m." 00:00:00";
    $fecha3m2 = $fecha3m." 23:59:59";
    $Dato5=mysqli_query($con,"SELECT IFNULL(SUM(Rate),'0') FROM Transaction AS A INNER JOIN stocktaking AS B ON A.Stocktaking_ID=B.ID WHERE B.User_User_Name='$Sesion' AND A.Date BETWEEN '$fecha3m1' AND '$fecha3m2'");
    //echo "3 dias:".$fecha3m."|".$fecha3m1."|".$fecha3m2."<br>"; //a la fecha hoy resto 1 dias
    $fecha2m = date("Y-m-d",strtotime($fechahoy."- 1 days"));
    $fecha2m1 = $fecha2m." 00:00:00";
    $fecha2m2 = $fecha2m." 23:59:59";
    $Dato6=mysqli_query($con,"SELECT IFNULL(SUM(Rate),'0') FROM Transaction AS A INNER JOIN stocktaking AS B ON A.Stocktaking_ID=B.ID WHERE B.User_User_Name='$Sesion' AND A.Date BETWEEN '$fecha2m1' AND '$fecha2m2'");
    //echo "2 dias:".$fecha2m."|".$fecha2m1."|".$fecha2m2."<br>";//a la fecha hoy resto 6 dias
    $fecha1m = date("Y-m-d");
    $fecha1m1 = $fecha1m." 00:00:00";
    $fecha1m2 = $fecha1m." 23:59:59";
    $Dato7=mysqli_query($con,"SELECT IFNULL(SUM(Rate),'0') FROM Transaction AS A INNER JOIN stocktaking AS B ON A.Stocktaking_ID=B.ID WHERE B.User_User_Name='$Sesion' AND A.Date BETWEEN '$fecha1m1' AND '$fecha1m2'");
    //echo "1 dias:".$fecha1m."|".$fecha1m1."|".$fecha1m2."<br>";//a la fecha hoy resto 6 dias
    //cadena para mandar al JS y mostrar
    //Estructura de la cadena
    //<n0> , <n1>, <n2>, <n..>, .... 
    $numeral="";
      while($row=mysqli_fetch_array($Dato1)){
      $numeral = $numeral.$row[0].",";
    } 
    
      while($row1=mysqli_fetch_array($Dato2)){
      $numeral = $numeral.$row1[0].",";
    } 
    
      while($row2=mysqli_fetch_array($Dato3)){
      $numeral = $numeral.$row2[0].",";
    } 
    
      while($row3=mysqli_fetch_array($Dato4)){
      $numeral = $numeral.$row3[0].",";
    } 
    
      while($row4=mysqli_fetch_array($Dato5)){
      $numeral = $numeral.$row4[0].",";
    } 
    
      while($row5=mysqli_fetch_array($Dato6)){
      $numeral = $numeral.$row5[0].",";
    } 
    
      while($row6=mysqli_fetch_array($Dato7)){
      $numeral = $numeral.$row6[0].",";
      }

      //Parte inferior de la barra, para Generar los Dias con palabra en español y Numeracion asociada arreglo
      //Arreglo de los dias
      //              0         1       2           3         4         5        6
      $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado"); //Creo un Arreglo con los diferentes dias de la semana
      $fechahoys = date("d-m-Y"); // Obtengo la fecha de hoy
      $fecha7m = date("d",strtotime($fechahoys."- 6 days")); // la fecha de hoy menos 6 dias
      $fecha7m = $dias[date('w',strtotime($fechahoys."- 6 days"))]." ".$fecha7m;// con forme al valor obtenid comparo en el arreglo y concateno
      $fecha6m = date("d",strtotime($fechahoys."- 5 days"));// la fecha de hoy menos 5 dias
      $fecha6m = $dias[date('w',strtotime($fechahoys."- 5 days"))]." ".$fecha6m;// con forme al valor obtenid comparo en el arreglo y concateno
      $fecha5m = date("d",strtotime($fechahoys."- 4 days"));// la fecha de hoy menos 4 dias
      $fecha5m = $dias[date('w',strtotime($fechahoys."- 4 days"))]." ".$fecha5m;// con forme al valor obtenid comparo en el arreglo y concateno
      $fecha4m = date("d",strtotime($fechahoys."- 3 days"));// la fecha de hoy menos 3 dias
      $fecha4m = $dias[date('w',strtotime($fechahoys."- 3 days"))]." ".$fecha4m;// con forme al valor obtenid comparo en el arreglo y concateno
      $fecha3m = date("d",strtotime($fechahoys."- 2 days"));// la fecha de hoy menos 2 dias
      $fecha3m = $dias[date('w',strtotime($fechahoys."- 2 days"))]." ".$fecha3m;// con forme al valor obtenid comparo en el arreglo y concateno
      $fecha2m = date("d",strtotime($fechahoys."- 1 days"));// la fecha de hoy menos 1 dias
      $fecha2m = $dias[date('w',strtotime($fechahoys."- 1 days"))]." ".$fecha2m;// con forme al valor obtenid comparo en el arreglo y concateno
      $fecha1m = date("d");//la fecha de hoy
      $fecha1m = $dias[date('w')]." ".$fecha1m;// la fecha de hoy comparada con el arreglo
      $cadenatotal = "'".$fecha7m."','".$fecha6m."','".$fecha5m."','".$fecha4m."','".$fecha3m."','".$fecha2m."','".$fecha1m."'"; //concateno la cadena
      //SELECT A.Folio, A.Date,A.Stocktaking_ID, Id, Product_Name, Rate, Sum(Rate),
      //Count(Rate) FROM Transaction AS A INNER JOIN STOCKTAKING AS B
      //ON A.Stocktaking_ID=B.ID WHERE A.Date BETWEEN '2018-10-10 00:00:00'
      //AND '2018-10-10 23:59:59'
?>