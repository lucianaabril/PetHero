<?php
    include("nav-bar.php");
?>
<html>
    <head>
        <title>Guardian Page</title>
        <link rel="stylesheet" href="Views\layout\styles\nav-bar.css">
    </head>
    <body>
        <a href="<?php echo FRONT_ROOT ?>User/logout">Cerrar sesión</a>
        <br>
        
        <nav class="menu">
            <ul>
                <li>Cambiar datos</li>
                <ul>
                    <li><a href="<?php echo FRONT_ROOT . "User/showGuardianDataView" ?>">Datos Guardian</a></li>            
                    <li><a href="<?php echo FRONT_ROOT . "User/showUserDataView" ?>">Datos Personales</a></li>
                </ul>
                <li>Listado de estadías</li>
            </ul>
        </nav>






    </body>
</html>