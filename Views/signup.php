<?php
    include("nav-bar.php");
?>
<html>
    <head>
        <title>Signup</title>
    </head>
    <body>
        <form action="<?php echo FRONT_ROOT . "User/Add"?>" method=POST>

            <label for="">Nombre:</label>
            <input type="text" name="nombre" placeholder="Ingrese su nombre" required>
            <br>
            <label for="">Apellido:</label>
            <input type="text" name="apellido" placeholder="Ingrese su apellido" required>
            <br>
            <label for="">Teléfono:</label>
            <input type="tel" name="telefono" placeholder="Ingrese su número de teléfono" required>
            <br>
            <label for="">Dirección:</label>
            <input type="text" name="direccion" placeholder="Ingrese su dirección" required>
            <br>
            <label for="">DNI:</label>
            <input type="text" name="dni" placeholder="Ingrese su DNI" required>
            <br>
            <label for="">Fecha de nacimiento:</label>
            <input type="date" name="cumpleanios" required>
            <br>
            <label for="">Email:</label>
            <input type="text" name="email" placeholder="Ingrese su email" required>
            <br>
            <label for="">Contraseña:</label>
            <input type="password" name="password" placeholder="Ingrese su contraseña" required>
            <br>
            <label for="">Tipo de usuario:</label>
            <select name="type">
                <option value="D">Dueño</option>
                <option value="G">Guardian</option>
            </select>
            <br>
                
            <button type="submit">Enviar</button>
        </form>
    </body>
</html>