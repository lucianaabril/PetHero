<?php
use Controllers\MascotasController as petC;
include("nav-bar.php");
$user = $_SESSION["loggeduser"];
?>
<html>
    <head>

    </head>
    <body>
        <form action="agregarReserva" method="post">
            <input type='hidden' name='dni_guardian' value="<?php echo $dni_guardian ?>">
            <input type='hidden' name='fecha' value="<?php echo $date?>">
            <input type="text" name="encuentro">
            <input type="time" name="hora">
            <?php
            $petc = new petC();
            $pets = $petc->getMascotasByDuenio();
            foreach($pets as $pet){
                if($pref == $pet->getTamanio()){
                    if($disp == "disponible" or $disp == $pet->getRaza()){
                        ?>
                        <input type='hidden' name='nombre_mascota' value="<?php echo $pet->getNombre()?>">
                        <button type="submit">Reservar para <?php echo $pet->getNombre() ?></button>
                        <?php
                    }
                }
            } ?>
        </form> <br> <a  class="backMenu" href= <?php echo(FRONT_ROOT . "User/getView")?>><input type="button" value="Volver al Menú"></a>
    </body>
</html>