<html>
    <head>
    </head>
    <body>
        <form action="<?php echo FRONT_ROOT . "User/changeDisponibilidad" ?>" method=POST>
            <label for=>Disponibilidad</label>
            <p>Ingrese el rango de disponibilidad:</p>
            <input type="date" name="fecha"></input>
            <br><br>
            <button type="submit">Guardar</button>
        </form>

        <a  class="backMenu" href= <?php echo( FRONT_ROOT . "User/getView")?>>
            <input type="button" value="Volver al Menú" />
        </a>
    </body>
</html>