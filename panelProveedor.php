<?php
    session_start();

    include('src/conexion_bd.php');
    include('src/graficaProvedorGanancias.php');
    include('src/DashboardProv.php');
    include('src/graficaProvedorClaseVenta.php');
    if(!$_SESSION || $_SESSION['Type_User']!=1){
      header("Location: index.php");
    }
    $user = $_SESSION['User_Name'];
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Panel de proveedor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap 4/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap 4/adicionalPanel.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="jsGraficas/highcharts.js" charset="utf-8"></script>
  <script src="jsGraficas/modules/exporting.js" charset="utf-8"></script>
  <script src="js/ajax.js" charset="utf-8"></script>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar" class="shadow">
      <div class="sidebar-header shadow-sm">
        <h3 class="text-center">Proveedor</h3>
        <strong><i class="fas fa-user-circle fa-lg"></i></strong>
      </div>

      <ul class="list-unstyled components">
        <li>
          <a href="#" onclick="toggleVisibility('provDash')" class="text-dark">
            <i class="fas fa-chart-line fa-lg"></i>Dashboard
          </a>
        </li>
        <li>
          <a href="#" onclick="toggleVisibility('agregarProducto')" class="text-dark">
            <i class="fas fa-plus-square fa-lg"></i>Agregar producto
          </a>
        </li>
        <li>
          <a href="#" onclick="toggleVisibility('modificarProducto')" class="text-dark">
            <i class="fas fa-edit fa-lg"></i>Modificar producto
          </a>
        </li>
        <li>
          <a href="src/proces-unlgn.php" class="text-dark">
            <i class="fas fa-user-circle fa-lg"></i>Cerrar sesión
          </a>
        </li>
      </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light bg-white shadow rounded">
        <div class="container-fluid">
          <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span></span>
          </button>
          <h4 class="mx-auto">Hola, proveedor</h4>
        </div>
      </nav>

      <div id="agregarProducto" style="display: none; padding-top: 3rem;">

        <div class="card w-100 mx-auto shadow">
          <div class="card-header bg-white text-center">
            <h4>Agregar producto</h4>
          </div>

          <div class="card-body">
            <form action="#" method="post" id="myForm">
              <h6 class="text-primary">Datos de producto</h6>
              <hr>
              <div class="form-row">
                <div class="col-md-3 mb-2">
                  <label for="nombreP">Nombre</label>
                  <input type="text" class="form-control" id="nameProd" name="nameProd" placeholder="Nombre" required>
                </div>
                <div class="col-md-3 mb-2">
                  <label for="price">Precio</label>
                  <input type="number" class="form-control" id="priceProd" name="priceProd" placeholder="Precio" required>
                </div>
                <div class="col-md-3 mb-2">
                  <label for="formSelect0">Selecciona una categoría</label>
                  <select class="form-control" id="catProd" name="catProd" onchange="optionfnt('ver-otcat')" required>
                    <?php
                      $sqlID = "SELECT Class FROM Stocktaking ORDER BY Class";
                      $check = $con->query($sqlID);
                      if(mysqli_num_rows($check) > 0) {
                        $aux = null;
                        while($fila = $check->fetch_assoc()) {
                          $class = $fila['Class'];
                          if($class != $aux) {
                            $aux = $class;
                            echo "
                                <option value=".$class.">$class</option>
                            ";
                          }
                        }
                      }
                    ?>
                    <option value="newCat">Categoría Nueva</option>
                  </select>
                  <!-- Categoria nueva div -->
                  <div style="display: none" class="table-responsive" id="ver-otcat" name="ver-otcat">
                    <input type="text" class="form-control" id="otherCat" name="otherCat" placeholder="Escribe la categoria nueva" required>
                  </div>
                </div>
                <div class="col-md-3 mb-2">
                  <label for="formSelect0">Selecciona una subcategoría</label>
                  <select class="form-control" id="subcatProd" name="subcatProd" onchange="optionfnt('ver-otsubcat')" required>
                    <?php
                      $sqlID = "SELECT SubClass FROM Stocktaking ORDER BY SubClass";
                      $check = $con->query($sqlID);
                      if(mysqli_num_rows($check) > 0) {
                        $aux = null;
                        while($fila = $check->fetch_assoc()) {
                          $subclass = $fila['SubClass'];
                          if($subclass != $aux) {
                            $aux = $subclass;
                            echo "
                                <option value=".$subclass.">$subclass</option>
                            ";
                          }
                        }
                      }
                    ?>
                    <option value="newSubCat">Subcategoría Nueva</option>
                  </select>
                  <!-- Subcategoria nueva div -->
                  <div style="display: none" class="table-responsive" id="ver-otsubcat" name="ver-otsubcat">
                    <input type="text" class="form-control" id="otherSubCat" name="otherSubCat" placeholder="Escribe la categoria nueva" required>
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-9 mb-6">
                  <label for="descrip">Descripcion</label>
                  <textarea class="form-control" name="descriptProd" id="descriptProd" rows="4" cols="80" placeholder="Descripción" required></textarea>
                </div>

                <div class="col-md-3 mb-2">
                  <label for="price">Provedor</label>
                  <select class="form-control" id="provProd" name="provProd" required>
                    <?php
                      $sqlID = "SELECT User_User_Name FROM Stocktaking ORDER BY User_User_Name";
                      $check = $con->query($sqlID);
                      if(mysqli_num_rows($check) > 0) {
                        $aux = null;
                        while($fila = $check->fetch_assoc()) {
                          $prob_user = $fila['User_User_Name'];
                          if($prob_user != $aux) {
                            $aux = $prob_user;
                            echo "
                                <option value=".$prob_user.">$prob_user</option>
                            ";
                          }
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="col-md-3 mb-3">
                    <p>Elige una imagen de producto</p>
                    <div class="input-file-container">
                      <form id="uploadimage" name="uploadimage" method="post" enctype="multipart/form-data">
                        <input class="input-file" id="my-file" type="file" name="imagProd" required>
                        <label tabindex="0" for="my-file" class="input-file-trigger">Elegir imagen</label>
                      </form>
                    </div>
                    <p class="file-return"></p>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit" id="addProdBtn" name="addProdBtn" onclick="btnAddProd(); myFunction();">Agregar producto</button>
              </form>
              <div style="padding-top: 1.2rem;"id="result">
              </div>
          </div>
          <!--CARD BODY-->
        </div>
        <!--CARD-->
      </div>
      <!--proveedor-->

      <!--modificar-->
      <div id="modificarProducto" style="display: none; padding-top: 3rem;">
        <div class="card w-100 mx-auto shadow">
          <div class="card-header header bg-white text-center">
            <h4>Modificar producto</h4>
          </div>
          <div class="card-body">
            <form action="src/verStockProveedor.php" method="post" id="buscarStockProv">
              <div class="form-row">
                <label for="buscarP">ID de producto</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="buscarProdProveedor" name="buscarProdProveedor" onkeyup="verStock()" placeholder="HP-1ZW00LA">
                </div>
              </div>
            </form>
            <form method="post">
              <div class="table-responsive" style="padding-top: 2rem;">
                <div id="live_data_prov" style="padding-top: 1.2rem;"></div>
                <span id="result_prov" style="padding-top: 1.2rem;"></span>
              </div>
            </form>
            <!--tabla-->
          </div>
          <!--Card-body-->
        </div>
        <!--CARD-->
      </div>
      <!--modificar-->

      <div id="provDash" style="display: block; padding-top: 3rem;">
        <div class="row">
          <div class="col-md-3 mb-2">
            <div class="card bg-gradGreen shadow-sm" style="border:none;">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h6 class="text-white">Ventas del día</h6>
                  </div>
                  <div class="col">
                    <h5 class="text-right text-white"><i class="fas fa-exchange-alt"></i></h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <h6 class="text-white">
                    <?php
                      VentProv($con, $user);
                    ?>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2">
            <div class="card bg-gradRed shadow-sm" style="border:none;">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h6 class="text-white">Ganacias del día</h6>
                  </div>
                  <div class="col">
                    <h5 class="text-right text-white"><i class="fas fa-shopping-cart"></i></i></h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                  <h6 class="text-white">
                    <?php
                      GanaHoyProv($con, $user);
                    ?>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2">
            <div class="card bg-gradBlue shadow-sm" style="border:none;">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h6 class="text-white">Ganancias de la semana</h6>
                  </div>
                  <div class="col">
                    <h5 class="text-right text-white"><i class="fas fa-users"></i></h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                  <h6 class="text-white">
                    <?php
                      VentSemProv($con, $user);
                    ?>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2">
            <div class="card bg-gradYellow shadow-sm" style="border:none;">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h6 class="text-white">Producto más vendido</h6>
                  </div>
                  <div class="col">
                    <h5 class="text-right text-white"><i class="fas fa-user-tie"></i></h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                  <h6 class="text-white">
                    <?php
                      TopSeller($con, $user);
                    ?>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--row-->

        <!--row-->
        <div class="row espacioHeight">
          <div class="col-md-9 mb-6">
            <div class="container-fluid rounded shadow-sm bg-white">
              <div id="tablaDash"></div>
            </div>
          </div>
          <div class="col-md-3 mb-6">
            <div class="container-fluid rounded shadow-sm bg-white">
              <div id="medioCirculo"></div>
            </div>
          </div>
        </div>
        <!--row-->
        </div>
        <!--row-->
      </div>
      <!--Admin dash-->
    </div>
    <!--contenido-->

    <script type="text/javascript">

    //deshabilitar flechas
    jQuery(document).ready( function($) {

      //deshabilitar indicadores en el input number
      // deshabilitar scroll en el input numero cuando sea enfocado
      $('form').on('focus', 'input[type=number]', function(e) {
          $(this).on('wheel', function(e) {
              e.preventDefault();
          });
      });

      // Restaurar el scroll
      $('form').on('blur', 'input[type=number]', function(e) {
          $(this).off('wheel');
      });

      // deshabilitar las flechas de teclado
      $('form').on('keydown', 'input[type=number]', function(e) {
          if ( e.which == 38 || e.which == 40 )
              e.preventDefault();
      });

    });
    //deshabilitar indicadores en el input number

      //control de panel lateral
      $(document).ready(function() {

        $('#sidebarCollapse').on('click', function() {
          $('#sidebar').toggleClass('active');
        });

      });
      //control de panel lateral

      //Mostrar la opcion de panel lateral
      var divs = ["agregarProducto", "modificarProducto", "provDash"];
      var visibleDivId = null;

      function toggleVisibility(divId) {
        if (visibleDivId === divId) {
          visibleDivId = null;
        } else {
          visibleDivId = divId;
        }
        hideNonVisibleDivs();
      }

      function hideNonVisibleDivs() {
        var i, divId, div;
        for (i = 0; i < divs.length; i++) {
          divId = divs[i];
          div = document.getElementById(divId);
          if (visibleDivId === divId) {
            div.style.display = "block";
          } else {
            div.style.display = "none";
          }
        }
      }
      //Mostrar la opcion de panel lateral

      //Seleccionar formulario
      $(function() {
        $('#formSelect0').change(function() {
          $('.formulario').hide();
          $('#' + $(this).val()).show();
        });
      });
      //seleccionar formulario


      //inputFile
      document.querySelector("html").classList.add('js');

      var fileInput  = document.querySelector( ".input-file" ),
          button     = document.querySelector( ".input-file-trigger" ),
          the_return = document.querySelector(".file-return");

      button.addEventListener( "keydown", function( event ) {
          if ( event.keyCode == 13 || event.keyCode == 32 ) {
              fileInput.focus();
          }
      });
      button.addEventListener( "click", function( event ) {
         fileInput.focus();
         return false;
      });
      fileInput.addEventListener( "change", function( event ) {
          the_return.innerHTML = document.getElementById("my-file").files[0].name; ;
      });
      //inputFile

      //tabla
      $(function () {
              $('#tablaDash').highcharts({
                  title: {
                      text: 'Ganancias de la Semana',
                      x: -20 //center
                  },
                  subtitle: {
                      text: '',
                      x: -20
                  },
                  xAxis: {
                      categories: [<?php echo $cadenatotal; ?>]
                  },
                  yAxis: {
                      title: {
                          text: 'Dinero $'
                      },labels: {
                      formatter: function () {
                          return this.value + '$';
                      }
                      },
                      plotLines: [{
                          value: 0,
                          width: 1,
                          color: '#808080'
                      }]
                  },
                  tooltip: {
                      valueSuffix: '$'
                  },
                  legend: {
                      layout: 'vertical',
                      align: 'right',
                      verticalAlign: 'middle',
                      borderWidth: 0
                  },
                  responsive: {
                      rules: [{
                          condition: {
                              maxWidth: 500
                          },
                          chartOptions: {
                              legend: {
                                  align: 'center',
                                  verticalAlign: 'bottom',
                                  layout: 'horizontal'
                              },
                              yAxis: {
                                  labels: {
                                      align: 'left',
                                      x: 0,
                                      y: -5
                                  },
                                  title: {
                                      text: null
                                  }
                              },
                              subtitle: {
                                  text: null
                              },
                              credits: {
                                  enabled: false
                              }
                          }
                      }]
                  },
                  series: [{
                      name: 'Ganancia por Dia',
                      data: [<?php
                             //A.Folio, A.Date, A.Stocktaking_ID, Id, Product_Name, Rate, COUNT(Rate)
                        echo $numeral;
                        ?>]
                   }]
              });
          });
      //tabla

      //medio circulo
      $(function () {
          $('#medioCirculo').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: 0,
                    plotShadow: false
                },
                title: {
                    text: 'Categoria con mas Ganacias',
                    align: 'center',
                    verticalAlign: 'top',
                    y: 70
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            enabled: true,
                            distance: 0,
                            style: {
                                fontWeight: 'bold',
                                color: 'white',
                                textShadow: '0px 1px 2px black'
                            }
                        },
                        startAngle: -90,
                        endAngle: 90,
                        center: ['50%', '75%']
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Browser share',
                    innerSize: '100%',
                    data: [
                            <?php
                              echo $numeral1;
                            ?>
                    ]
                }]
            });
        });
      //medio ciruclo

    </script>
</body>

</html>
