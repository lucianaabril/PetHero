<?php
    include("nav-bar.php");
    $g = $guardian;
?>
<html>
    <head>
    </head>
    <body>
        <?php
            echo "Nombre: " . $g->getNombre(); ?> <br> <?php
            echo "Apellido: " . $g->getApellido(); ?> <br> <?php
            echo "DNI: " . $g->getDni(); ?> <br> <?php
            echo "Tarifa: " . $g->getTarifa(); ?> <br> <?php
            echo "CBU: " . $g->getCBU(); ?> <br> <?php
            echo "Alias: " . $g->getAlias(); ?> <br> <br>

            <!--<form action="<?php echo FRONT_ROOT . "uploadComprobante"?>" method=POST enctype="multipart/form-data">
                <h3>Ingrese el comprobante de pago</h3> <br>
                <input type="file" name="comprobante">
                <button type="submit">Guardar</button>
            </form>-->
            <a  class="backMenu" href= <?php echo(FRONT_ROOT . "User/getView")?>><input type="button" value="Volver al Menú"></a>
    </body>
</html>