<!DOCTYPE html>

<?php
    $connect = mysqli_connect("localhost", "root", "", "testing");
    $query = "SELECT * FROM tbl_user ORDER BY idProducto ASC";
    $result = mysqli_query($connect, $query);
?>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Panel de proveedor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap 4/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap 4/adicionalPanel.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <script src="jsGraficas/highcharts.js" charset="utf-8"></script>
  <script src="jsGraficas/modules/exporting.js" charset="utf-8"></script>
  <script src="js/jquery.tabledit.js" charset="utf-8"></script>
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
          <a href="#" onclick="toggleVisibility('adminDash')" class="text-dark">
            <i class="fas fa-chart-line fa-lg"></i>Dashboard
          </a>
        </li>
        <li>
          <a href="#" onclick="toggleVisibility('agregarProducto')" class="text-dark">
            <i class="fas fa-plus-square fa-lg"></i>Agregar producto
          </a>
        </li>
        <li>
          <a href="#" onclick="toggleVisibility('eliminarProducto')" class="text-dark">
            <i class="fas fa-minus-square fa-lg"></i>Eliminar producto
          </a>
        </li>
        <li>
          <a href="#" onclick="toggleVisibility('modificarProducto')" class="text-dark">
            <i class="fas fa-edit fa-lg"></i>Modificar producto
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
              <form action="#" method="post">
                <h6 class="text-primary">Datos de producto</h6>
                <hr>
                <div class="form-row">
                  <div class="col-md-3 mb-2">
                    <label for="idprod">ID producto</label>
                    <input type="text" class="form-control" id="idprod" name="idProductoNuevo" required>
                  </div>
                  <div class="col-md-3 mb-2">
                    <label for="nombreP">Nombre</label>
                    <input type="text" class="form-control" id="nombreP" name="nombreProducto" required>
                  </div>
                  <div class="col-md-3 mb-2">
                    <label for="price">Precio</label>
                    <input type="text" class="form-control" id="price" name="precioProducto" required>
                  </div>
                  <div class="col-md-3 mb-2">
                    <label for="formSelect0">Selecciona una categoría</label>
                    <select class="form-control" id="formSelect0" required>
                      <option value=""></option>
                      <option value="0">Laptops</option>
                      <option value="1">Smartphones</option>
                      <option value="2">Tablets</option>
                      <option value="3">Escritorios</option>
                    </select>
                  </div>
                </div>

                <div class="form-row" style="padding-bottom: 2rem;">
                  <div class="col-md-9 mb-6">
                    <label for="descrip">Descripcion</label>
                    <textarea class="form-control" name="descripcion" rows="4" cols="80" required></textarea>
                  </div>
                  <div class="col-md-3 mb-3">
                    <p>Elige una imagen de producto</p>
                    <div class="input-file-container">
                      <input class="input-file" id="my-file" type="file" name="imagen" required>
                      <label tabindex="0" for="my-file" class="input-file-trigger">Elegir imagen</label>
                    </div>
                    <p class="file-return"></p>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Agregar producto</button>
              </form>

          </div>
          <!--CARD BODY-->
        </div>
        <!--CARD-->
      </div>
      <!--proveedor-->

      <div id="eliminarProducto" style="display: none; padding-top: 3rem;">
        <div class="card w-100 mx-auto shadow">
          <div class="card-header header bg-white text-center">
            <h4>Eliminar producto</h4>
          </div>
          <div class="card-body">
            <form action="#" method="post">
              <div class="form-row">
                <label for="eliminarP">ID de producto</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="eliminarP" placeholder="HP-1ZW00LA" name="eliminarProducto">
                </div>
              </div>
            </form>
            <div class="table-responsive" style="padding-top: 2rem;">
              <table class="table table-hover table-bordered">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">ID Producto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Precio</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-toggle="modal" data-target="#modalConfirmacionProducto">
                    <td>HP-1ZW00LA</td>
                    <td>Laptop HP Omen 15</td>
                    <td>Laptops</td>
                    <td class="text-success">$24,000</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--tabla-->
          </div>
          <!--Card-body-->
        </div>
        <!--CARD-->
      </div>
      <!--eliminar-->

      <!--modificar-->
      <div id="modificarProducto" style="display: none; padding-top: 3rem;">
        <div class="card w-100 mx-auto shadow">
          <div class="card-header header bg-white text-center">
            <h4>Modificar producto</h4>
          </div>
          <div class="card-body">
            <form action="#" method="post">
              <div class="form-row" >
                <label for="modificarP">ID de producto</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="modificarP" placeholder="HP-1Z00WA" name="modificarProd">
                </div>
              </div>
            </form>
            <form method="post">
              <div class="table-responsive" style="padding-top: 2rem;">
                <table id="editable_table" class="table table-bordered table-striped">
                 <thead>
                  <tr>
                   <th>ID producto</th>
                   <th>Nombre</th>
                   <th>Precio</th>
                   <th>Descripcion</th>
                   <th>Categoría</th>
                  </tr>
                 </thead>
                 <tbody>
                 <?php
                 while($row = mysqli_fetch_array($result))
                 {
                  echo '
                  <tr>
                   <td>'.$row["idProducto"].'</td>
                   <td>'.$row["nomProd"].'</td>
                   <td>'.$row["precio"].'</td>
                   <td>'.$row["descripcion"].'</td>
                   <td>'.$row["cat"].'</td>
                  </tr>
                  ';
                 }
                 ?>
                 </tbody>
                </table>
               </div>
            </form>
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
                    <h6 class="text-white">20</h6>
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
                    <h6 class="text-white">20</h6>
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
                    <h6 class="text-white">Gnaancias de la semana</h6>
                  </div>
                  <div class="col">
                    <h5 class="text-right text-white"><i class="fas fa-users"></i></h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <h6 class="text-white">20</h6>
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
                    <h6 class="text-white">20</h6>
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

    <!--Modal confirmación usuario-->
    <div class="modal" id="modalConfirmacionProducto">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Confirmar</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <h4>¿Quieres eliminar el producto -ID- de la lista?</h4>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="eliminarProv">Aceptar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    <!--Modal confirmación-->

    <script type="text/javascript">
      //control de panel lateral
      $(document).ready(function() {

        $('#sidebarCollapse').on('click', function() {
          $('#sidebar').toggleClass('active');
        });

      });
      //control de panel lateral

      //Mostrar la opcion de panel lateral
      var divs = ["agregarProducto", "eliminarProducto", "modificarProducto", "provDash"];
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
                      text: 'Monthly Average Temperature',
                      x: -20 //center
                  },
                  subtitle: {
                      text: 'Source: WorldClimate.com',
                      x: -20
                  },
                  xAxis: {
                      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                          'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                  },
                  yAxis: {
                      title: {
                          text: 'Temperature (°C)'
                      },
                      plotLines: [{
                          value: 0,
                          width: 1,
                          color: '#808080'
                      }]
                  },
                  tooltip: {
                      valueSuffix: '°C'
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
                      name: 'Tokyo',
                      data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
                  }, {
                      name: 'New York',
                      data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
                  }, {
                      name: 'Berlin',
                      data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
                  }, {
                      name: 'London',
                      data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
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
                    text: 'Browser<br>shares',
                    align: 'center',
                    verticalAlign: 'middle',
                    y: 50
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            enabled: true,
                            distance: -50,
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
                    innerSize: '50%',
                    data: [
                        ['Firefox',   45.0],
                        ['IE',       26.8],
                        ['Chrome', 12.8],
                        ['Safari',    8.5],
                        ['Opera',     6.2],
                        {
                            name: 'Others',
                            y: 0.7,
                            dataLabels: {
                                enabled: false
                            }
                        }
                    ]
                }]
            });
        });
      //medio ciruclo

      //tablaEdit
      $(document).ready(function(){
           $('#editable_table').Tabledit({
            url:'action.php',
            columns:{
             identifier:[0, 'idProducto'],
             editable:[[1, 'nomProd'], [2, 'precio'], [3, 'descripcion'], [4, 'cat']]
            },
            restoreButton:true,
            onSuccess:function(data, textStatus, jqXHR)
            {
             if(data.action == 'delete')
             {
              $('#'+data.idProducto).remove();
             }
            }
           });

      });
      //tablaEdit

    </script>
</body>

</html>
