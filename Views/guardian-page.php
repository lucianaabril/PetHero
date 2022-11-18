<?php
    include("nav-bar.php");
?>
<html>
    <head>
        <title>Guardian Page</title>
        <style><?php include(VIEWS_PATH . "/layout/styles/duenio-page.css")?></style>
    </head>
    <body>        
        <nav class="menu">
            <ul>
                <li>Cambiar datos</li>
                <ul>
                    <li><a href="<?php echo FRONT_ROOT . "User/showGuardianDataView" ?>">Modificar tarifa y preferencias</a></li>
                    <li><a href="<?php echo FRONT_ROOT . "User/showDisponibilidadView" ?>">Modificar disponibilidad</a></li>                        
                    <!--<li><a href="<?php echo FRONT_ROOT . "User/showUserDataView" ?>">Datos Personales</a></li>-->
                </ul>
                <li>Listado de reservas</li>
                <li><a href="<?php echo FRONT_ROOT . "Reservas/pendientes" ?>">Ver reservas pendientes</a></li>
                <li><a href="<?php echo FRONT_ROOT . "Reservas/programadas" ?>">Ver reservas programdas</a></li> 
                <li><a href="<?php echo FRONT_ROOT . "Reservas/historial" ?>">Ver historial de reservas</a></li> 
                <li><a href="<?php echo FRONT_ROOT . "User/showPerfil" ?>">Ver perfil</a></li> 
                <li><a href="<?php echo FRONT_ROOT . "User/logout" ?>">Cerrar sesión</a></li>
            </ul>
        </nav>
    </body>
</html>