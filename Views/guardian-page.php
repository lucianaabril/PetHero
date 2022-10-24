<?php
    include("nav-bar.php");
?>
<html>
    <head>
        <title>Guardian Page</title>
    </head>
    <body>        
        <nav class="menu">
            <ul>
                <li>Cambiar datos</li>
                <ul>
                    <li><a href="<?php echo FRONT_ROOT . "User/showGuardianDataView" ?>">Datos Guardian</a></li>            
                    <li><a href="<?php echo FRONT_ROOT . "User/showUserDataView" ?>">Datos Personales</a></li>
                </ul>
                <li>Listado de estadías</li>
                <li><a href="<?php echo FRONT_ROOT . "User/showPerfil" ?>">Ver perfil</a></li>
                <li><a href="<?php echo FRONT_ROOT . "User/logout" ?>">Cerrar sesión</a></li>
            </ul>
        </nav>
    </body>
</html>