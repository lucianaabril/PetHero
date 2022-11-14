<?php 
include("nav-bar.php");
use Controllers\MascotasController as petC;
use Controllers\MascotasController;
use Models\Duenio as duenio;
?>
<html>
    <head>

    </head>
    <body>
        <h2 class="fechas-disp">Fechas Disponibles del guardián</h2> <br>

        <?php
        $petc = new petC();
        $pets = $petc->getMascotasByDuenio();
        $flag = false;
        foreach($guardian->getDisponibilidad() as $fecha=>$disp){
            ?> <br> <h3><?php echo $fecha . ": " . $disp?></h3>
            <?php
            foreach($pets as $pet){
                if($disp == "disponible" or $disp == $pet->getRaza()){
                    $flag = true;
                }
            }
            if($flag){
            ?>
            <form action="processReserva" method=post >
            <input type='hidden' name='dniGuardian' value="<?php echo $guardian->getDni()?>">
            <input type='hidden' name='disponibilidad' value="<?php echo $disp?>">
            <input type='hidden' name='preferencia' value="<?php echo $guardian->getPreferencia()?>">
            <input type='hidden' name='fecha' value="<?php echo $fecha?>">
            <button type="submit">Reservar</button>
            </form>
            <?php
            }
        }

        ?>

<a  class="backMenu" href= <?php echo( FRONT_ROOT . "User/getView")?>>
            <input type="button" value="Volver al Menú" />
        </a>
    </body>
</html>
<?php

