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
      <h2>Guardianes disponibles</h2>
      <?php
          $controller = new Controller();
          $array = $controller->viewGuardianesAsDuenio();
          
          foreach($array as $guardian){ ?>
          <div class="guardian">
          <?php
            echo "Nombre: ". $guardian->getNombre();?><html> <br></html> <?php
            echo "Apellido: ". $guardian->getApellido();?><html> <br></html> <?php
            echo "Telefono: ". $guardian->getTelefono();?><html> <br></html> <?php
            echo "Tarifa: ". $guardian->getTarifa();?><html> <br></html> <?php
            echo "Preferencia: ". $guardian->getPreferencia(); ?>
            <html> </div> </html>
          <?php
          } ?> <br>
          <div class="filtro">
            <a href="<?php echo FRONT_ROOT ?>User/showFiltrarFechaView">Filtrar fecha</a>
          </div>

          <a  class="backMenu" href= <?php echo(FRONT_ROOT . "User/getView")?>><input type="button" value="Volver al Menú"></a>
      </body>
</html>