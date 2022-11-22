<?php
  include("nav-bar.php");
?>

<html>
    <head></head>
    <body>
        <form action="metodoPago" method=POST>
            <h2>Seleccione el método de pago</h2>
            <select name="metodo_pago">
                <option value="tarjeta">Tajeta</option>
                <option value="mercado_pago">Mercado Pago</option>
            </select>
            <input type="hidden" name="dni_guardian" value="<?php echo $dni ?>">
            <input type="hidden" name="id_reserva" value="<?php echo $id ?>">
            <button type="submit">Continuar</button>
            <a  class="backMenu" href= <?php echo(FRONT_ROOT . "User/getView")?>><input type="button" value="Volver al Menú"></a>
        </form>
    </body>
</html>