<?php
use Controllers\ReservasController as resC;
include("nav-bar.php");
$user = $_SESSION["loggeduser"];
$resC = new resC();
$reservas = $resC->reservasPendientes($user->getDni());
?>

<html>
    <head>

    </head>
    <body>
        <h3>Reservas Pendientes:</h3> <br>
        <?php
        foreach($reservas as $res){
            //echo "id reserva: " . $res->getId_reserva();
            echo "Fecha: " . $res->getFecha(); ?> <br> <?php
            echo "Hora: " . $res->gethora(); ?> <br> <?php
            echo "Encuentro: " . $res->getEncuentro(); ?> <br> <?php
            echo "Nombre de la mascota: " . $res->getNombre_mascota(); ?> <br> <?php
            echo "Estado: " . $res->getEstado(); ?>

            <form action="aceptarReserva">
            <button type="submit">Aceptar</button>
            </form>
            <form action="rechazarReserva">
            <button type="submit">Rechazar</button>
            <br> <br>
            </form><?php
        }
        ?>
    </body>
</html>