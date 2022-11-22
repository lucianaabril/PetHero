<?php
    include("nav-bar.php");

    ?> <h3>Cupón de pago</h3> <?php
    echo "Fecha de pago: " . $cupon->getFecha(); ?> <br> <?php
    echo "Monto total: " . $cupon->getMonto(); ?> <br> <?php
    echo "Detalles de la operación: " . "<br>" . $cupon->getDetalles(); ?> <br> <br>
    <a  class="backMenu" href= <?php echo( FRONT_ROOT . "User/getView")?>><input type="button" value="Volver al Menú" />