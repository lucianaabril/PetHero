<?php
    include("nav-bar.php");

    ?> <h3>Cupón de pago</h3> <?php

    foreach($array as $cupon){
        echo "Fecha de pago: " . $cupon->getFecha(); ?> <br> <?php
        echo "Monto total: " . $cupon->getMonto(); ?> <br> <?php
        echo "Detalles de la operación: " . "<br>" . $cupon->getDetalles(); ?> <br> <br> <?php
    } ?>
    <a  class="backMenu" href= <?php echo( FRONT_ROOT . "User/getView")?>><input type="button" value="Volver al Menú" />