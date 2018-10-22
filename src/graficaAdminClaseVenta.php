<?php

date_default_timezone_set('america/mexico_city'); //configuro el uso horario a trabajar
$fechahoys = date("Y-m-d"); // obtengo la fecha de hoy
$fecha1semana= date("Y-m-d",strtotime($fechahoys."- 6 days"));

$fecha1m1 = $fecha1semana." 00:00:00";
$fecha1m2 = $fechahoys." 23:59:59";
$base=mysqli_query($con,"SELECT DISTINCT SubClass AS Busqueda,(SELECT IFNULL(SUM(B.Amount),'1') FROM Stocktaking AS A INNER JOIN Transaction AS B ON A.ID=B.Stocktaking_ID WHERE A.Class=Busqueda AND B.DATE BETWEEN '$fecha1semana' AND '$fechahoys' ) AS Cantidad_De_Ventas FROM Stocktaking ORDER BY Cantidad_de_ventas DESC LIMIT 3");
$numeral1="";
  while($row=mysqli_fetch_array($base)){
  $numeral1 = $numeral1."['".$row[0]."',".$row[1]."],";
} 
//
/*
$fecha7m = date("Y-m-d",strtotime($fechahoy."- 6 days")); //a la fecha hoy resto 6 dias
$fecha7m1 = $fecha7m." 00:00:00";
$fecha7m2 = $fecha7m." 23:59:59";

$fecha1m = date("Y-m-d");
$fecha1m1 = $fecha1m." 00:00:00";
$fecha1m2 = $fecha1m." 23:59:59";
$Dato7=mysqli_query($con,"SELECT IFNULL(SUM(Rate),'0') FROM Transaction AS A INNER JOIN Stocktaking AS B ON A.Stocktaking_ID=B.ID WHERE A.Date BETWEEN '$fecha1m1' AND '$fecha1m2'");

$numeral="";
  while($row=mysqli_fetch_array($Dato1)){
  $numeral = $numeral.$row[0].",";
} 
*/
?>