<?php
include("nav-bar.php");
use Controllers\MascotasController as Controller;

?>

<html>
    <head>

    </head>
    <body>
        <div class=header-mis-mascotas>
            <h2>Mis Mascotas:</h2><br>
        </div>
        <div class=list-mis-mascotas>
            <?php 
            $controller = new Controller();
            $array = $controller->getMascotasByDuenio();
            $i = 1;
            foreach($array as $pet){
                echo "Mascota " . $i ;?><html> <br></html> <?php
                $i++;
                echo "Nombre: ".$pet->getNombre();?><html> <br></html> <?php
                echo "Edad: ".$pet->getEdad();?><html> <br></html> <?php
                echo "Raza: ".$pet->getRaza();?><html> <br></html> <?php
                echo "Tamaño: ".$pet->getTamanio();?><html> <br></html> <?php
                echo "Obervaciones: ".$pet->getObservaciones();?><html> <br></html> <?php
                echo "Tipo: ".$pet->getTipo();?><html> <br></html> <?php
                ?><html> <br></html> <?php
            }
            ?>
        </div>
    </body>
</html>