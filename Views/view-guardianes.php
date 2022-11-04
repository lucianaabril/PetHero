<?php
use Models\Duenio as Duenio;
use DAO\GuardianDAO as GuardianDAO;
use Controllers\MascotasController as MascotasController;
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
          $petController = new MascotasController();
          $user = new Duenio();
          $user = $_SESSION["loggeduser"];
          $pets = $petController->getMascotasByDuenio($user->getDni());
          $guardianDAO = new GuardianDAO();
          $guardianes = $guardianDAO->GetAll();

          foreach($pets as $pet){
            foreach($guardianes as $guardian){
              if($pet->getTamanio() == $guardian->getPreferencia()){
                  ?> <div class="guardian">
                  <?php
                  echo "Nombre: ".$guardian->getNombre();?><html> <br></html> <?php
                  echo "Apellido: ".$guardian->getApellido();?><html> <br></html> <?php
                  echo "Telefono: ".$guardian->getTelefono();?><html> <br></html> <?php
                  echo "Disponibilidad: ". print_r($guardian->getDisponibilidad());?><html> <br></html> <?php
                  echo "Tarifa: ".$guardian->getTarifa();?><html> <br></html> <?php
                  echo "Preferencia: ".$guardian->getPreferencia();?><html> <br></html> <?php
                  ?><html> <br>
                  </div> 
                  </html> <?php
              }
            }
          } ?> <br>
          <div class="filtro">
            <a href="<?php echo FRONT_ROOT ?>User/showFiltrarFechasView">Filtrar por rango de fechas</a>
          </div>
      </body>
</html>