<html>
    <head>
    <!--form para cambiar los datos personales que tienen en común dueño y guardian-->
    </head>
    <body>
        <form action="changeDatos" method=POST>
            <h2>Datos bancarios</h2>

            <h3>CBU</h3>
            <input type="text" name="cbu" placeholder="Ingrese el CBU"> <br>

            <h3>Alias</h3>
            <input type="text" name="alias" placeholder="Ingrese el alias"> <br> <br>

            <button type="submit">Guardar</button>
            <a  class="backMenu" href= <?php echo(FRONT_ROOT . "User/getView")?>><input type="button" value="Volver al Menú"></a>
        </form>

    </body>
</html>