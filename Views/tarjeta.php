<?php
    include("nav-bar.php");
?>
<html>
    <head>
    </head>
    <body>
        <form action="tarjeta" method=POST>
            <h2>Elija su tarjeta</h2>
            <select name="tipo_tarjeta">
                <option value="visa_credito">Visa crédito</option>
                <option value="visa_credito">Visa débito</option>
                <option value="mastercard">Mastercard</option>
            </select>
            <br> <br>

            <h2>Ingrese el número de su tarjeta</h2> <br>
            <input type="text" name="numero_tarjeta" placeholder="Ingrese el número aquí"> <br> <br>

            <h2>Ingrese los dígitos de seguridad</h2> <br>
            <input type="text" name="seguridad" placeholder="Ingrese los tres dígitos aquí"> <br> <br>

            <h2>Ingrese la fecha de vencimiento</h2> <br>
            <input type="date" name="vencimiento"> <br> <br>

            <input type="hidden" name="id_reserva" value="<?php echo $id?>">
            <input type="hidden" name="monto_total" value="<?php echo $monto_total?>">

            <button type="submit">Aceptar</button>
            <a  class="backMenu" href= <?php echo(FRONT_ROOT . "User/getView")?>><input type="button" value="Volver al Menú"></a>
        </form>
    </body>
</html>