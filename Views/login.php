<?php
    include("nav-bar.php");
?>
<html>
    <head>
        <title>Login</title>
        <link href="stylesheet" alt=''>
    </head>
    <body>
        <h2>LOGIN:</h2>
        <form action="<?php echo FRONT_ROOT?>Auth/login" method=POST>
            <div>
                <label for=email>Email:</label>
                <input type=text name=email placeholder="Ingrese su email">
                <br>
                <br>
                <label for=password>Contraseña:</label>
                <input type=password name=password placeholder="Ingrese su constraseña">
            </div>
            <br>
            <button type="submit">Enviar</button>
        </form>
    </body>
</html>