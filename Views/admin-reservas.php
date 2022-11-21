<?php
    include("nav-bar.php");

    foreach($array as $fecha=>$res){
        foreach($res as $r){ ?> <br> <?php
            echo "ID reserva: " . $r->getId_reserva(); ?> <br> <?php
            echo "Fecha: " . $r->getFecha(); ?> <br> <?php
            echo "Hora: " . $r->gethora(); ?> <br> <?php
            echo "Encuentro: " . $r->getEncuentro(); ?> <br> <?php
            echo "Nombre de la mascota: " . $r->getNombre_mascota(); ?> <br> <?php
            echo "Estado: " . $r->getEstado(); ?> <br> <?php
        } ?> <br>
        <html> 
                <form action="programarReserva" method=POST>
                    <input type="hidden" name="id_reserva" value="<?php echo $r->getId_reserva()?>">
                    <button type="submit">Aceptar reserva</button>
                </form>
                <form action="rechazarReserva" method=POST>
                    <input type="hidden" name="id_reserva" value="<?php echo $r->getId_reserva()?>">
                    <button type="submit">Rechazar reserva</button>
                </form>
            </html> <?php
    }
?>