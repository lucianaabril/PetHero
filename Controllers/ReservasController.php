<?php
namespace Controllers;
use DAO\ReservaDAO as reservaDAO;
use Models\Reserva as Reserva;
use Models\Duenio as Duenio;
use Models\Pago as Pago;
use DAO\GuardianDAO as guardianDAO;
use Models\Guardian as Guardian;

class ReservasController{
    public $reservaDAO;

    function __construct()
    {
        $this->reservaDAO = new reservaDAO();
    }

    public function Add($fecha = '',$hora = '',$encuentro='',$id_reserva='',$dni_guardian='',$nombre_mascota=''){
        $reserva = new Reserva();
        $reserva->setFecha($fecha);
        $reserva->setHora($hora);
        $reserva->setEncuentro($encuentro);
        $reserva->setId_reserva($id_reserva);
        $reserva->setEstado("pendiente");
        $reserva->setDniGuardian($dni_guardian);
        $user = new Duenio();
        $user = $_SESSION["loggeduser"];
        $reserva->setDniDuenio($user->getDni());
        $reserva->setNombre_mascota($nombre_mascota);

        $this->reservaDAO->Add($reserva);
    }

    function reservarGuardian($dni){
        $guardian = new Guardian();
        $dao = new guardianDAO();
        $guardian = $dao->getByDNI($dni);
        include_once(VIEWS_PATH . "create-reserva.php");
    }
}


?>