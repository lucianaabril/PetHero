<html>
    <head>
        <title>Guardain Data</title>
    </head>
    <body>
        <form action="<?php echo FRONT_ROOT . "User/changeGuardianData"?>" method=POST>
            <label for=>Tarifa</label>
            <br>
            <input type="number" name="tarifa" placeholder="Ingrese su tarifa"></input>
            <br><br>
            <label for=>Preferencias</label>
            <p>Elija el tamaño de perro que cuida:</p>
            <input type="radio" name="preferencia" value="pequenio">Pequeño</input>
            <input type="radio" name="preferencia" value="mediano">Mediano</input>
            <input type="radio" name="preferencia" value="grande">Grande</input>
            <br><br>
            <button type="submit">Guardar</button>
        </form>
    </body>
</html>