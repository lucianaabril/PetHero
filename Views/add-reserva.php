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
            <input type="text" name="encuentro" placeholder="Lugar de encuentro">
            <input type="time" name="hora" placholder="hora">
            <select name="nombre_mascota">
                <?php foreach($arrayPos as $pos){?>
                    <option value="<?php echo $pets[$pos]->getNombre()?>"> <?php echo $pets[$pos]->getNombre()?> </option>
                    <?php
                } ?>
            </select>
            <button type="submit">Reservar</button>
        </form>
        <br>
        <a  class="backMenu" href= <?php echo(FRONT_ROOT . "User/getView")?>><input type="button" value="Volver al Menú"></a>
    </body>
</html>