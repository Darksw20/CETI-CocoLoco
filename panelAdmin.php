<?php
  session_start();

  include('src/conexion_bd.php');
  include('src/graficaAdminGanancias.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>ProyectoCoco</title>
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
  <script src="js/ajax.js" charset="utf-8"></script>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar" class="shadow">
      <div class="sidebar-header shadow-sm">
        <h3 class="text-center">Admin</h3>
        <strong><i class="fas fa-user-circle fa-lg"></i></strong>
      </div>

      <ul class="list-unstyled components">
        <li>
          <a href="#" onclick="toggleVisibility('adminDash')" class="text-dark">
            <i class="fas fa-list-alt fa-lg"></i>Dashboard
          </a>
        </li>
        <li>
          <a href="#AdminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-dark">
            <i class="fas fa-address-card fa-lg"></i>Administar Cuentas
          </a>
          <ul class="collapse list-unstyled" id="AdminSubmenu">
            <li>
              <a href="#" onclick="toggleVisibility('proveedor')" class="text-dark">Proveedor</a>
            </li>
            <li>
              <a href="#" onclick="toggleVisibility('usuario')" class="text-dark">Usuario</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#GananciasSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-dark">
            <i class="fas fa-money-check-alt fa-lg"></i>Ganancias
          </a>
          <ul class="collapse list-unstyled" id="GananciasSubmenu">
            <li>
              <a href="#" onclick="toggleVisibility('gananciasTotales')" class="text-dark">Ganancias Totales</a>
            </li>
            <li>
              <a href="#" onclick="toggleVisibility('gananciasProducto')" class="text-dark">Ganancias por producto</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" onclick="toggleVisibility('inventario')" class="text-dark">
            <i class="fas fa-list-alt fa-lg"></i>Inventario
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
          </button>
        </div>
      </nav>

      <div id="proveedor" style="display: none; padding-top: 3rem;">

        <div class="card w-100 mx-auto shadow">
          <div class="card-header bg-info">
            <select class="custom-select" id="formSelect0">
              <option value="0">Agregar proveedor</option>
              <option value="1">Eliminar proveedor</option>
            </select>
          </div>

          <div class="card-body">
            <div id="0" class="formulario 0">
              <form action="src/agregarProveedor.php" method="post">
                <h6 class="text-primary">Datos de usuario</h6>
                <hr>
                <div class="form-row">
                  <div class="col-md-3 mb-2">
                    <label for="nombreProv">Nombre</label>
                    <input type="text" class="form-control" id="nombreProv" name="nombreProveedor" required>
                  </div>
                  <div class="col-md-3 mb-2">
                    <label for="apPaterno">Apellido</label>
                    <input type="text" class="form-control" id="apPaterno" name="apellido" required>
                  </div>
                  <div class="col-md-3 mb-2">
                    <label for="tel">Teléfono</label>
                    <input type="text" class="form-control" id="tel" name="telefono" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-3 mb-3">
                    <label for="mail">Correo</label>
                    <input type="text" class="form-control" id="mail" name="correoProveedor" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="pass">Contraseña</label>
                    <input type="text" class="form-control" id="pass" name="contrasenaProveedor" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="userName">Nombre de usuario</label>
                    <input type="text" class="form-control" id="userName" name="usernameProveedor" required>
                  </div>
                </div>

                <h6 class="text-primary">Domicilio</h6>
                <hr>
                <div class="form-row">
                  <div class="col-md-4 mb-2">
                    <label for="street">Calle</label>
                    <input type="text" class="form-control" id="street" name="calle" required>
                  </div>
                  <div class="col-md-2 mb-2">
                    <label for="num">Número</label>
                    <input type="text" class="form-control" id="num" name="numeroCalle" required>
                  </div>
                  <div class="col-md-4 mb-2">
                    <label for="formSelect0">Colonia</label>
                    <select class="form-control" id="formSelect0" name="colonia" required>
                      <option value=""></option>
                      <option value="0">La chida</option>
                      <option value="1">La chafa</option>
                      <option value="2">La fresa</option>
                      <option value="3">La naca</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-2">
                    <label for="cp">Código postal</label>
                    <input type="text" class="form-control" id="cp" name="codigoPostal" required>
                  </div>
                </div>
                <input type="hidden" name="Type_User" value="1">
                <button class="btn btn-primary" type="submit">Agregar proveedor</button>
              </form>
            </div>
            <!--formulario 0-->

            <div id="1" class="formulario 1" style="display: none;">
              <form action="src/eliminarUser.php" method="post" id="buscar-proveedor">
                <div class="form-row">
                  <label for="deleteProv">Nombre de usuario</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="deleteProv" name="deleteProv" onkeyup="buscarProv()" placeholder="nombre_usuario">
                  </div>
                </div>
              </form>

            <!--tablaScript eliminarProv-->
            <div class="table-responsive" id="ver-buscarProv">

            </div>
            <!--tablaScript eliminarProv-->

            </div>
            <!--formulario 1-->
          </div>
          <!--CARD BODY-->
        </div>
        <!--CARD-->
      </div>
      <!--proveedor-->

      <div id="usuario" style="display: none; padding-top: 3rem;">
        <div class="card w-100 mx-auto shadow">
          <div class="card-header header bg-white text-center">
            <h4>Eliminar usuario</h4>
          </div>
          <div class="card-body">
            <form action="src/eliminarUser.php" method="post" id="buscar-usuario">
              <div class="form-row">
                <label for="eliminarUser">Nombre de usuario</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="deleteUser" name="deleteUser" onkeyup="buscarUser()" placeholder="yisusChrist98">
                </div>
              </div>
            </form>
            <div class="table-responsive" id="ver-buscarUser">

            </div>
            <!--tabla-->
          </div>
          <!--Card-body-->
        </div>
        <!--CARD-->
      </div>
      <!--Usuario-->

      <div id="gananciasTotales" style="display: none; padding-top: 3rem;">
        <div class="card w-100 mx-auto shadow">
          <div class="card-header header bg-white text-center">
            <h4>Ganacias totales</h4>
          </div>
          <div class="card-body">
            <form action="#" method="post">
              <div class="form-row">
                <label for="ganaciasProv">Proveedor</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="ganaciasProv" name="buscarProveedor" placeholder="Hewlett-Packard">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="table-responsive" style="padding-top: 2rem;">
              <table class="table table-bordered">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Ingreso generado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Intel</td>
                    <td class="text-success">$30,000,000</td>
                  </tr>
                  <tr>
                    <td>Hewlett-Packard</td>
                    <td class="text-success">$50,000,000</td>
                  </tr>
                  <tr>
                    <td>Nvidia</td>
                    <td class="text-success">$10,000,000</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--tabla-->
            <div class="container bg-light rounded shadow-sm" style="padding: 20px;">
              <h6>Ingreso total</h6>
              <hr>
              <h5 class="text-success">
                <i class="fas fa-dollar-sign fa-lg"></i> 90,000,000
              </h5>
            </div>
          </div>
          <!--Card-body-->
        </div>
        <!--CARD-->
      </div>
      <!--gananciasTotales-->

      <div id="gananciasProducto" style="display: none; padding-top: 3rem;">
        <div class="card w-100 mx-auto shadow">
          <div class="card-header header bg-white text-center">
            <h4>Ganacias por producto</h4>
          </div>
          <div class="card-body">
            <form action="src/transacciones.php" method="post" id="transaccion">
              <div class="form-row">
                <label for="idProd">Nombre del producto o categoría</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="buscarPGanancia" name="buscarPGanancia" onkeyup="verGanciasPProducto()" placeholder="Intoduce el nombre del producto o la categoría">
                </div>
              </div>
            </form>
            <div class="table-responsive" style="padding-top: 2rem;" id="editable_tableTransaccion">
            </div>
            <!--tabla-->
            <div class="container w-75 bg-light rounded shadow-sm" style="padding: 20px;">
              <div class="row">
                <?php include('src/cuentas.php'); cuentas($con); ?>
              </div> 
            </div>
          </div>
          <!--Card-body-->
        </div>
        <!--CARD-->
      </div>
      <!--ganacias por producto-->

      <div id="inventario" style="display: none; padding-top: 3rem;">
        <div class="card w-100 mx-auto shadow">
          <div class="card-header header bg-white text-center">
            <h4>Inventario en tienda</h4>
          </div>
          <div class="card-body">
            <form action="src/verStock.php" method="post" id="buscarStock">
              <div class="form-row">
                <label for="buscarP">ID de producto</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="buscarP" name="buscarP" onkeyup="verStock()" placeholder="HP-1ZW00LA">
                </div>
              </div>
            </form>
            <form method="post">
              <div class="table-responsive" style="padding-top: 2rem;">
                <div id="live_data" style="padding-top: 1.2rem;"></div>
                <span id="result" style="padding-top: 1.2rem;"></span>
              </div>
            </form>
            <!--tabla-->
          </div>
          <!--Card-body-->
        </div>
        <!--CARD-->
      </div>
      <!--Inventario-->

      <div id="adminDash" style="display: block; padding-top: 3rem;">
        <div class="row">
          <div class="col-md-3 mb-2">
            <div class="card bg-gradGreen shadow-sm" style="border:none;">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h6 class="text-white">Transacciones del día</h6>
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
                    <h6 class="text-white">Total de productos</h6>
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
                    <h6 class="text-white">Total de usuarios</h6>
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
                    <h6 class="text-white">Total de proveedores</h6>
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
      <!--Admin dash-->
      <div class="row" id="msg">
        <div class="container-fluid">
          <?php
            if (!empty($_GET['msg'])) {
              echo "     
                  <div class='alert alert-success position-absolute' role='alert' onclick='cerrarMsg()'>".
                    $_GET['msg']
                  ."</div>
              "; 
            }
          ?>
        </div>
      </div>
    </div>
    <!--contenido-->

    <script type="text/javascript">
      //control de panel lateral
      $(document).ready(function() {

        $('#sidebarCollapse').on('click', function() {
          $('#sidebar').toggleClass('active');
        });

      });
      //control de panel lateral

      //Mostrar la opcion de panel lateral
      var divs = ["proveedor", "usuario", "gananciasTotales", "gananciasProducto", "inventario", "adminDash"];
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
                        ?>
                        ]
                  },]
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

      /*$(document).ready(function(){
        $('#editable_table').Tabledit({
        url: 'actualizarStock.php',
        columns: {
            identifier:[0, 'ID'],
            editable:[[2, 'Lot']]
        },
        editButton: false,
        deleteButton: false,
        hideIdentifier: true,
        restoreButton: false,
        onSuccess:function(data, textStatus, jqXHR) {
            if(data.action == 'delete') {
                $('#'+data.ID).remove();
            }
        }
        });
    });*/
    </script>
    </div>
</body>

</html>
