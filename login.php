<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/MDBoottrap/mdb.min.css">
    <link rel="stylesheet" href="css/bootstrap 4/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap 4/adicional.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <title>proyectoCoco</title>
    <style media="screen">
    </style>
  </head>

  <body>
    <nav class="navbar bg-primary navbar-dark fixed-top mr-auto">
      <div class="col bg-success">
        <a class="navbar-brand" href="#">
          <img src="imagenes/logo1-transparent.png" alt="logo" width="40" height="40"> La tiendita
        </a>
      </div>
      <div class="col bg-warning">
        <form method="post">
            <div class="input-group">
              <input type="text" class="form-control mx-auto" placeholder="Buscar">
              <button class="btn btn-danger" type="submit">Ir</button>
            </div>
        </form>
      </div>
      <div class="col bg-danger">
        <ul class="navbar-nav ml-auto btn-group">
          <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-primary" name="button"><a class="nav-link text-white font-weight-bold" href="#" data-toggle="modal" data-target="#modalRegistro">Entrar</a></button>
            <button type="button" class="btn btn-primary" name="button"><a class="nav-link text-white font-weight-bold" href="#" data-toggle="modal" data-target="#modalCarrito">Carrito</a></button>
          </div>
        </ul>
      </div>
    </nav>

    <!--Carrusel-->
    <div class="container" style="padding-top: 5rem; padding-bottom: 2rem;">
      <div id="demo" class="carousel slide" data-ride="carousel">

        <ul class="carousel-indicators">
          <li data-target="#demo" data-slide-to="0" class="active"></li>
          <li data-target="#demo" data-slide-to="1"></li>
          <li data-target="#demo" data-slide-to="2"></li>
        </ul>

        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="imagenes/gray.jpg" alt="Los Angeles" width="100%" height="300">
          </div>
          <div class="carousel-item">
            <img src="imagenes/gray.jpg" alt="Chicago" width="100%" height="300">
            <div class="carousel-caption">
              <h3>nombre</h3>
              <p>Descripcion de producto</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="imagenes/gray.jpg" alt="New York" width="100%" height="300">
          </div>
        </div>

        <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
    </div>
    <!--Carrusel-->

    <!--modal-->
    <div class="modal" id="modalRegistro">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Inicia sesión o registrate</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
              <div class="card w-75 mx-auto">
                <div class="card-header">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#login">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#signup">Registrarse</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div id="login" class="container tab-pane active"><br>
                      <form action="login.php" method="post">
                        <div class="form-group">
                          <label for="email">Correo electrónico:</label>
                          <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                          <label for="pwd">Contraseña:</label>
                          <input type="password" class="form-control" id="pwd">
                        </div>
                        <div class="form-group form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox"> Recordarme
                          </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                      </form>
                    </div>
                    <div id="signup" class="container tab-pane fade"><br>
                      <form action="login.php" method="post">
                        <div class="form-group">
                          <label for="email">Correo electrónico:</label>
                          <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-row">
                          <div class="col">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre">
                          </div>
                          <div class="col">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido">
                          </div>
                        </div>
                        <div class="form-group" style="padding-top: 10px;">
                          <label for="pwd">Contraseña:</label>
                          <input type="password" class="form-control" id="pwd">
                        </div>
                        <div class="form-group">
                          <label for="pwd2">Repertir contraseña:</label>
                          <input type="password" class="form-control" id="pwd2">
                        </div>
                        <button type="submit" class="btn btn-primary" name="button">Registrar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!--Modal -->

    <div class="modal" id="modalCarrito">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Carrito de compras</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
      
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="alert alert-primary text-center">
      <strong>Lo más vendido</strong>
    </div>

    <div class="card-deck espacioWidth espacioHeight">
      <div class="card">
        <img class="card-img-top" src="imagenes/gray.jpg" alt="Card image cap"  width="100" height="350">
        <div class="card-header">
          <h5 class="card-title">Nombre</h5>
        </div>
        <div class="card-body">
          <h5 class="card-title text-danger">Precio</h5>
          <p class="card-text">Descripción de producto.</p>
          <button type="button" class="btn btn-danger" name="button">Ir al producto</button>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="imagenes/gray.jpg" alt="Card image cap"  width="100" height="350">
        <div class="card-header">
          <h5 class="card-title">Nombre</h5>
        </div>
        <div class="card-body">
          <h5 class="card-title text-danger">Precio</h5>
          <p class="card-text">Descripción de producto.</p>
          <button type="button" class="btn btn-danger" name="button">Ir al producto</button>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="imagenes/gray.jpg" alt="Card image cap"  width="100" height="350">
        <div class="card-header">
          <h5 class="card-title">Nombre</h5>
        </div>
        <div class="card-body">
          <h5 class="card-title text-danger">Precio</h5>
          <p class="card-text">Descripción de producto.</p>
          <button type="button" class="btn btn-danger" name="button">Ir al producto</button>
        </div>
      </div>
    </div>

    <div class="card-deck espacioWidth espacioHeight">
      <div class="card">
        <img class="card-img-top" src="imagenes/gray.jpg" alt="Card image cap"  width="100" height="350">
        <div class="card-header">
          <h5 class="card-title">Nombre</h5>
        </div>
        <div class="card-body">
          <h5 class="card-title text-danger">Precio</h5>
          <p class="card-text">Descripción de producto.</p>
          <button type="button" class="btn btn-danger" name="button">Ir al producto</button>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="imagenes/gray.jpg" alt="Card image cap"  width="100" height="350">
        <div class="card-header">
          <h5 class="card-title">Nombre</h5>
        </div>
        <div class="card-body">
          <h5 class="card-title text-danger">Precio</h5>
          <p class="card-text">Descripción de producto.</p>
          <button type="button" class="btn btn-danger" name="button">Ir al producto</button>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="imagenes/gray.jpg" alt="Card image cap"  width="100" height="350">
        <div class="card-header">
          <h5 class="card-title">Nombre</h5>
        </div>
        <div class="card-body">
          <h5 class="card-title text-danger">Precio</h5>
          <p class="card-text">Descripción de producto.</p>
          <button type="button" class="btn btn-danger" name="button">Ir al producto</button>
        </div>
      </div>
    </div>

    <div class="container-fluid bg-primary">
      <div class="row">
        <div class="col-lg-1">
          <a href="#">
            <img src="imagenes/logo1-transparent.png" alt="logo" width="40" height="40">
          </a>
        </div>
        <div class="col">
          <h3 class="text-white text-left"> La tiendita</h3>
        </div>
      </div>
    </div>

    <div class="container-fluid" style="padding: 2rem; background-color: #fff;">
      <div class="row">
        <div class="col-lg-2">
          <img src="imagenes/logo.png" alt="logo" width="200" height="200">
        </div>
        <div class="col-lg-5">
          <hr>
          <p class="text-primary"><br>Proyecto desarrollado para la materia Sistemas distribuidos</p>
          <br>
          <hr>
        </div>
        <div class="col-lg-1 text-right ml-auto">
          <p>
            <h5 class="card-title"><a href="#">Contacto</a></h5>
          </p>
        </div>
        <div class="col-lg-1 text-right ml-auto">
          <p>
            <h5 class="card-title"><a href="#">Nosotros</a></h5>
          </p>
        </div>
        <div class="col-lg-1 text-right ml-auto">
          <p>
            <h5 class="card-title"><a href="#">Proyecto</a></h5>
          </p>
        </div>
      </div>
      <hr>
    </div>
    <footer class="container-fluid text-center" style="padding-top: 1rem;">
      <p>Copyright (c) 2018 Diseñado por 8B1.</p>
    </footer>

  </body>
</html>
