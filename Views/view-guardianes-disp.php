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
          $guardianes = $controller->getArrayFiltrado();          
          foreach($guardianes as $guardian){ ?>
          <div class="guardian">
          <?php
            echo "Nombre: ". $guardian->getNombre();?><html> <br></html> <?php
            echo "Apellido: ". $guardian->getApellido();?><html> <br></html> <?php
            echo "Telefono: ". $guardian->getTelefono();?><html> <br></html> <?php
            $disponibilidad = $guardian->getDisponibilidad();
            echo "Disponibilidad: "; ?> <html> <br> </html> <?php
            foreach($disponibilidad as $fecha){
              echo $fecha; ?> <br> <?php
            }
            echo "Tarifa: ". $guardian->getTarifa();?><html> <br></html> <?php
            echo "Preferencia: ". $guardian->getPreferencia(); ?>
            <html> </div> </html> <?php
          } ?> </html> <br>