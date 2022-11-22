<?php
    include("nav-bar.php");

    if($array){ ?>
        <h3>Reservas por pagar</h3> <br> <?php
        foreach($array as $fecha=>$res){
            foreach($res as $r){
                echo "ID reserva: " . $r->getId_reserva(); ?> <br> <?php
                echo "Fecha: " . $r->getFecha(); ?> <br> <?php
                echo "Hora: " . $r->gethora(); ?> <br> <?php
                echo "Encuentro: " . $r->getEncuentro(); ?> <br> <?php
                echo "Nombre de la mascota: " . $r->getNombre_mascota(); ?> <br> <?php
                echo "Estado: " . $r->getEstado(); ?> <br> <br> <?php
            } ?>
            <html> 
                <form action="pagar" method=POST>
                    <input type="hidden" name="dni_guardian" value="<?php echo $r->getDniGuardian()?>">
                    <input type="hidden" name="id_reserva" value="<?php echo $r->getId_reserva()?>">
                    <button type="submit">Pagar reserva</button>
                </form>
            </html> <br> <?php
        }
    }

    if($arrayP){ ?>
        <h3>Reservas pagas</h3> <br> <?php
        foreach($arrayP as $fecha=>$res){
            foreach($res as $r){
                echo "ID reserva: " . $r->getId_reserva(); ?> <br> <?php
                echo "Fecha: " . $r->getFecha(); ?> <br> <?php
                echo "Hora: " . $r->gethora(); ?> <br> <?php
                echo "Encuentro: " . $r->getEncuentro(); ?> <br> <?php
                echo "Nombre de la mascota: " . $r->getNombre_mascota(); ?> <br> <?php
                echo "Estado: " . $r->getEstado(); ?> <br> <br> <?php
            } 
        } 
    } ?>
    <a  class="backMenu" href= <?php echo(FRONT_ROOT . "User/getView")?>><input type="button" value="Volver al Menú"></a>