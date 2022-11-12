<?php

use Controllers\UserController as UController;
?>

<html>

<head>
<style><?php include(VIEWS_PATH . "/layout/styles/perfil.css")?></style>
</head>

<body>
    <h2 class="MiPerfil">Mi Perfil</h2>
    <div class="data">
        <?php
        $controller = new UController();
        $user = $_SESSION["loggeduser"];
        $type = $controller->getUserType();

        if ($type == 'g') {
            $guardian = $this->guardianDAO->getByEmail($_SESSION['email']); ?> <html> <br>

            </html> <?php
                    echo "Nombre: " . $guardian->getNombre(); ?> <html> <br>

            </html> <?php
                    echo "Apellido: " . $guardian->getApellido(); ?> <html> <br>

            </html> <?php
                    echo "DNI: " . $guardian->getDni(); ?> <html> <br>

            </html> <?php
                    echo "Teléfono: " . $guardian->getTelefono(); ?> <html> <br>

            </html> <?php
                    echo "Dirección: " . $guardian->getDireccion(); ?> <html> <br>

            </html> <?php
                    echo "Fecha de nacimiento: " . $guardian->getCumpleanios(); ?> <html> <br>

            </html> <?php
                    $disp = $guardian->getDisponibilidad();
                    echo "Disponibilidad: " . $disp[0] . " / " . $disp[1]; ?> <html> <br>

            </html> <?php
                    echo "Tarifa: $" . $guardian->getTarifa(); ?> <html> <br>

            </html> <?php
                    echo "Preferencia tamaño de perro: " . $guardian->getPreferencia(); ?> <html> <br>

            </html> <?php


                } elseif ($type == 'd') {

                    $duenio = $this->duenioDAO->getByEmail($_SESSION['email']); ?> <html> <br>

            </html> <?php
                    echo "Nombre: " . $duenio->getNombre(); ?> <html> <br>

            </html> <?php
                    echo "Apellido: " . $duenio->getApellido(); ?> <html> <br>

            </html> <?php
                    echo "DNI: " . $duenio->getDni(); ?> <html> <br>

            </html> <?php
                    echo "Teléfono: " . $duenio->getTelefono(); ?> <html> <br>

            </html> <?php
                    echo "Dirección: " . $duenio->getDireccion(); ?> <html> <br>

            </html> <?php
                    echo "Fecha de nacimiento: " . $duenio->getCumpleanios(); ?> <html> <br>

            </html> <?php
                }
                    ?>

    <a  class="backMenu" href= <?php echo( FRONT_ROOT . "User/getView")?>>
   <input type="button" value="Volver al Menú" />
    </a>
</body>

</html>