<?php
    include("nav-bar.php");

    foreach($array as $res){ ?> <br> <?php
        echo "ID reserva: " . $res->getId_reserva(); ?> <br> <?php
        echo "Fecha: " . $res->getFecha(); ?> <br> <?php
        echo "Hora: " . $res->gethora(); ?> <br> <?php
        echo "Encuentro: " . $res->getEncuentro(); ?> <br> <?php
        echo "Nombre de la mascota: " . $res->getNombre_mascota(); ?> <br> <?php
        echo "Estado: " . $res->getEstado(); ?> <br>
        <html> 
            <form action="programarReserva" method=POST>
                <input type="hidden" name="id_reserva" value="<?php echo $res->getId_reserva()?>">
                <button type="submit">Aceptar reserva</button>
            </form>
            <form action="rechazarReserva" method=POST>
                <input type="hidden" name="id_reserva" value="<?php echo $res->getId_reserva()?>">
                <button type="submit">Rechazar reserva</button>
            </form>
        </html> <?php
    }
?>