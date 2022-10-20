<html>
    <head>
        <title>Signup</title>
    </head>
    <body>
        <form action="<?php echo FRONT_ROOT . "User/Add"?>" method=POST>
            <label for="">Email:</label>
            <input type="text" name="email" placeholder="Ingrese su email"></input>
            <label for="">Contraseña:</label>
            <input type="password" name="password" placeholder="Ingrese su contraseña"></input>
            <label for="">Tipo de usuario:</label>
            <select>
                <option name="type" value="D">Dueño</option>
                <option name="type" value="G">Guardian</option>
            </select>
            <label for="">Nombre:</label>
            <input type="text" name="nombre" placeholder="Ingrese su nombre">
            <label for="">Apellido:</label>
            <input type="text" name="apellido" placeholder="Ingrese su apellido">
            <label for="">Teléfono:</label>
            <input type="tel" name="telefono" placeholder="Ingrese su número de teléfono">
            <label for="">Dirección:</label>
            <input type="text" name="direccion" placeholder="Ingrese su dirección">

            <? if($_POST['type'] == 'D') ?>
            <label for="">DNI:</label>
            <input type="text" name="dni" placeholder="Ingrese su DNI">

            <? else ?>
            <label for="">CUIL:</label>
            <input type="text" name="cuil" placeholder="Ingrese su CUIL">
            <label for="">Disponibilidad:</label>
            <input type="text" name="disponibilidad" placeholder="Ingrese su disponibilidad horaria">
            <label for="">Tarifa:</label>
            <input type="text" name="tarifa" placeholder="Ingrese su tarifa">
                
            <button type="submit">Enviar</button>
        </form>
    </body>
</html>