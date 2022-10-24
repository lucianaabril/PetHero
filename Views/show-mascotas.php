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
            include(FRONT_ROOT . "Mascotas/showMascotasByDuenio");
            ?>
        </div>
    </body>
</html>