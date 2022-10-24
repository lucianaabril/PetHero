<?php
    include("nav-bar.php");
?>
<html>
    <head>
        <title>Dueño Page</title>
    </head>
    <body>
        <nav class="menu">
            <ul>
                <li><a href="<?php echo FRONT_ROOT ?>Mascotas/viewAddMascota">Agregar Mascota</a></li>
                <li><a href="<?php echo FRONT_ROOT ?>Mascotas/showMascotasByDuenio">Ver mis mascotas</a></li>
                <li><a href="<?php echo FRONT_ROOT ?>User/showPerfil">Ver perfil</a></li>
                <li><a href="<?php echo FRONT_ROOT ?>User/logout">Cerrar sesión</a></li>
            </ul>
        </nav>
    </body>
</html>