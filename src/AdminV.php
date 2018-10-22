<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Select To USER</title>
  </head>
  <body>
      <div>
          <fieldset>
            <legend>Found Data:</legend>
            <div>
              <?php
              include 'conexion_bd.php';
              include 'AdminP.php';
              include 'ProvP.php';
              UserCount($conexion);
              ProvCount($conexion);
              ProdCount($conexion);
              TransCount($conexion);
              GanaHoyProv($conexion,'Pedromaxor');
              VentProv($conexion, 'Pedromaxor');
              VentSemProv($conexion, 'Pedromaxor');
              TopSeller($conexion, 'Pedromaxor');
              ?>
            </div>
          </fieldset>
      </div>
  </body>
    <footer>
    </footer>
</html>
