<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Departamentos</title>

  <link rel="stylesheet" href="css/bootstrap 4/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap 4/adicional.css">
  <link href="css/uikit.css" rel="stylesheet" type="text/css" />
  <link href="css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>

<body>

  <!-- barra navegacion Categorias -->
  <div class="section-header sticky-top bg-white">
    <section class="header-main">
      <div class="container sticky-top">
        <div class="row align-items-center">
          <div class="col-lg-5-24 col-sm-5 col-4">
            <div class="brand-wrap">
              <img class="logo" src="">
              <h2 class="logo-text">CoCo</h2>
            </div>
            <!-- brand-wrap.// -->
          </div>
          <div class="col-lg-13-24 col-sm-12 order-3 order-lg-2">
            <form action="#">
              <div class="input-group w-100">
                <input type="text" class="form-control" style="width:60%;" name="buscador" placeholder="¿Que buscamos?">
                <div class="input-group-append">
                  <button class="btn btn-outline-dark" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
            <!-- search-wrap .end// -->
          </div>
          <!-- col.// -->
          <div class="col-lg-6-24 col-sm-7 col-8  order-2  order-lg-3">
            <div class="d-flex justify-content-end">
              <div class="widget-header">
                <small class="title text-muted">¡Hola, invitado!</small>
                <div>
                  <a href="#" class="text-dark" data-toggle="modal" data-target="#modalModificar">Login</a>
                  <span class="dark-transp"> | </span>
                  <a href="#" class="text-dark">Crear cuenta</a>
                </div>
              </div>
              <a href="#" class="widget-header border-left pl-3 ml-3" data-toggle="modal" data-target="#modalCarrito">
                <div class="icontext">
                  <div class="icon-wrap icon-sm round border"><i class="fa fa-shopping-cart text-dark"></i></div>
                </div>
                <span class="badge badge-pill badge-danger notify">0</span>
              </a>
            </div>
            <!-- widgets-wrap.// -->
          </div>
          <!-- col.// -->
        </div>
        <!-- row.// -->
      </div>
      <!-- container.// -->
    </section>
    <!-- header-main .// -->
  </div>
  <!-- barra navegacion Categorias -->

</body>

</html>
