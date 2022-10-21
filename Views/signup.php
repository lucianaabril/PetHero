<?php
    include("nav-bar.php");
?>
<html>
    <head>
        <title>Signup</title>
    </head>
    <body>
        <form action="<?php echo FRONT_ROOT . "User/Add"?>" method=POST>
            <label for="">Email:</label>
            <input type="text" name="email" placeholder="Ingrese su email"></input>
            <br>
            <label for="">Contraseña:</label>
            <input type="password" name="password" placeholder="Ingrese su contraseña"></input>
            <br>
            <label for="">Tipo de usuario:</label>
            <select>
                <option name="type" value="D">Dueño</option>
                <option name="type" value="G">Guardian</option>
            </select>
            <br>

            <? if($_POST['type'] == 'D') ?>
            <label for="">Nombre:</label>
            <input type="text" name="nombre" placeholder="Ingrese su nombre">
            <br>
            <label for="">Apellido:</label>
            <input type="text" name="apellido" placeholder="Ingrese su apellido">
            <br>
            <label for="">Teléfono:</label>
            <input type="tel" name="telefono" placeholder="Ingrese su número de teléfono">
            <br>
            <label for="">Dirección:</label>
            <input type="text" name="direccion" placeholder="Ingrese su dirección">
            <br>
            <label for="">DNI:</label>
            <input type="text" name="dni" placeholder="Ingrese su DNI">
            <br>

            <? else ?>
            <label for="">Nombre:</label>
            <input type="text" name="nombre" placeholder="Ingrese su nombre">
            <br>
            <label for="">Apellido:</label>
            <input type="text" name="apellido" placeholder="Ingrese su apellido">
            <br>
            <label for="">Teléfono:</label>
            <input type="tel" name="telefono" placeholder="Ingrese su número de teléfono">
            <br>
            <label for="">Dirección:</label>
            <input type="text" name="direccion" placeholder="Ingrese su dirección">
            <br>
            <label for="">CUIL:</label>
            <input type="text" name="cuil" placeholder="Ingrese su CUIL">
            <br>
            <label for="">Disponibilidad:</label>
            <input type="text" name="disponibilidad" placeholder="Ingrese su disponibilidad horaria">
            <br>
            <label for="">Tarifa:</label>
            <input type="text" name="tarifa" placeholder="Ingrese su tarifa">
            <br>
                
            <button type="submit">Enviar</button>
        </form>
    </body>
</html>