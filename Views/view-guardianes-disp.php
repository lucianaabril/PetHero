<?php
  use Controllers\UserController as Controller;
  include("nav-bar.php");
?>

<html>
    <head>
      <title>Guardianes</title>
      <style><?php include(VIEWS_PATH . "/layout/styles/view-guardianes.css")?></style>
    </head>
    <body>
      <h2>Guardianes disponibles en la fecha indicada:</h2>
      <?php
          $controller = new Controller();
          $array = $controller->filtrarFecha();
          
          foreach($array as $guardian){ ?>
          <div class="guardian">
          <?php
            echo "Nombre: ".$guardian->getNombre();?> <html> <br> </html> <?php
            echo "Apellido: ".$guardian->getApellido();?> <html> <br> </html> <?php
            echo "Telefono: ".$guardian->getTelefono();?> <html> <br> </html> <?php
            echo "Disponibilidad: ". print_r($guardian->getDisponibilidad());?> <html> <br ></html> <?php
            echo "Tarifa: ".$guardian->getTarifa();?> <html> <br> </html> <?php
            echo "Preferencia: ".$guardian->getPreferencia();?> <html> <br> </html> <?php
          ?> <html> <br>
          </div> </html>
          <?php
          } ?> <br>