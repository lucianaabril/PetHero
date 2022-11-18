<?php
    include("nav-bar.php");
    $arrayR = $array;

    foreach($arrayR as $res){
        echo "id reserva: " . $res->getId_reserva();
        echo "Fecha: " . $res->getFecha(); ?> <br> <?php
        echo "Hora: " . $res->gethora(); ?> <br> <?php
        echo "Encuentro: " . $res->getEncuentro(); ?> <br> <?php
        echo "Nombre de la mascota: " . $res->getNombre_mascota(); ?> <br> <?php
        echo "Estado: " . $res->getEstado(); 
        if($res->getEstado() == 'programada'){ ?>
            <html> 
                <form action="User/pagar" method=POST>
                    <input type="hidden" name="id_reserva" value="<?php echo $res->getId_reserva()?>">
                    <button type="submit">Pagar reserva</button>
                </form>
            </html>
        <?php
        }
    }




?>