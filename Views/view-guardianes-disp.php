<?php
  use Controllers\UserController as Controller;
  use Controllers\MascotasController as MascotasController;
  use Controllers\ReservasController as ReservasController;
  use Models\Duenio as Duenio;
  use DAO\GuardianDAO as GuardianDAO;
  use function Controllers\reservarGuardian;

  include("nav-bar.php");
  include("Controllers/ReservasController.php");

?>

<html>
    <head>
      <title>Guardianes</title>
      <style><?php include(VIEWS_PATH . "/layout/styles/view-guardianes.css")?></style>
    </head>
    <body>
    
      <h2>Guardianes disponibles en la fecha indicada:</h2>
      <?php
          $array = $arrayD;
          $rango_d = implode(", ", $rango);
                    
          if($array){
          foreach($array as $guardian){ ?>
          <div class="guardian">
          <?php
            echo "Nombre: ". $guardian->getNombre();?><html> <br></html> <?php
            echo "Apellido: ". $guardian->getApellido();?><html> <br></html> <?php
            echo "Telefono: ". $guardian->getTelefono();?><html> <br></html> <?php
            echo "Tarifa: ". $guardian->getTarifa();?><html> <br></html> <?php
            echo "Preferencia: ". $guardian->getPreferencia(); 
            ?>
            <html> 
              <form action="realizarReserva" method="post">
              <input type="hidden" name='rango_d' value="<?php echo $rango_d ?>">
              <input type='hidden' name='dni' value="<?php echo $guardian->getDni()?>">
              <button type="submit">Reservar</button>
              </form>
              
              <!--<script>
                function clickMe(){
                var result = "<?php //reservarGuardian($guardian->getDni()) ?>";
                document.write(result);
                }
            </script> -->
            </div> 
            </html> <?php
          } 
          ?> <html> <br> <?php 
        } else{
          echo "no hay guardianes disponibles para la fecha solicitada"; 
        } 
        ?>
        <html>
          <a  class="backMenu" href= <?php echo( FRONT_ROOT . "User/getView")?>>
            <input type="button" value="Volver al Menú" />
          </a>
        </html>
    </body>
</html>