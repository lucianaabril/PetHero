<?php
    include("nav-bar.php");

    $reservas = $array;
    $titulo = $estado;

    ?> <html> <h2> <?php echo $titulo ?> </h2> <br> </html> <?php
    foreach($reservas as $res){
        echo "ID Reserva: " . $res->getId_reserva(); ?> <br> <?php
        echo "Fecha: " . $res->getFecha(); ?> <br> <?php
        echo "Hora: " . $res->gethora(); ?> <br> <?php
        echo "Encuentro: " . $res->getEncuentro(); ?> <br> <?php
        echo "Nombre de la mascota: " . $res->getNombre_mascota(); ?> <br> <?php
        echo "Estado: " . $res->getEstado(); ?> <br> <br> <?php
    }
?>