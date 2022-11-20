<?php
    include("nav-bar.php");
?>
<html>
    <head>
        <title>Dueño Page</title>
        <style><?php include(VIEWS_PATH . "/layout/styles/duenio-page.css")?></style>
    </head>
    <body>
        <span class="menu">
            <ul>
                <li><a href="<?php echo FRONT_ROOT ?>Mascotas/viewAddMascota">Agregar Mascota</a></li>
                <li><a href="<?php echo FRONT_ROOT ?>User/showMascotas">Ver mis mascotas</a></li>
                <li><a href="<?php echo FRONT_ROOT ?>User/showViewGuardianesAsDuenio">Ver guardianes</a></li>
                <li><a href="<?php echo FRONT_ROOT ?>User/showPerfil">Ver perfil</a></li>
                <li>Ver mis reservas</li>
                <li><a href="<?php echo FRONT_ROOT . "Reservas/pendientes" ?>">Ver reservas pendientes</a></li>
                <li><a href="<?php echo FRONT_ROOT . "Reservas/programadas" ?>">Ver reservas programadas</a></li> 
                <li><a href="<?php echo FRONT_ROOT . "Reservas/historial" ?>">Ver historial de reservas</a></li> 
                <li><a href="<?php echo FRONT_ROOT ?>User/logout">Cerrar sesión</a></li>
            </ul>
        </span>
    </body>
</html>