<?php
    include("nav-bar.php");
    use FFI\Exception as Exception;
?>
<html>
    <head>
        <title>Login</title>
        <link href="stylesheet" alt=''>
    </head>
    <body>
        <h2>LOGIN:</h2> <?php
        try{ ?>
            <form action="<?php echo FRONT_ROOT . "User/login"?>" method=POST>
            <div>
                <label for="">Email:</label>
                <input type="text" name="email" placeholder="Ingrese su email">
                <br>
                <br>
                <label for="">Contraseña:</label>
                <input type="password" name="password" placeholder="Ingrese su constraseña">
                <br>
                <br>
                <?php echo "¿No tienes una cuenta? Haz "?><a href="<?php echo FRONT_ROOT . "User/ShowSignupView" ?>">click aqui</a>
            </div>
            <br>
            <button type="submit">Enviar</button>
        </form> <?php
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        } ?>
    </body>
</html>