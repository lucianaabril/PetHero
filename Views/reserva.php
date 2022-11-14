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
        <h3>reserva:</h3>
        <?php
        foreach($reservas as $res){
            //echo "id reserva: " . $res->getId_reserva();
            echo "encuentro: " . $res->getEncuentro(); ?> <br> <?php
            echo "hora: " . $res->gethora();
            ?>
            

            <form action="aceptarReserva">
            <button type="submit">Aceptar</button>
            </form>
            <form action="rechazarReserva">
            <button type="submit">Rechazar</button>
            </form><?php
        }
        ?>
    </body>
</html>