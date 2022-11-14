<?php
namespace Controllers;
use DAO\ReservaDAO as reservaDAO;
use Models\Reserva as Reserva;
use Models\Duenio as Duenio;
use Models\Pago as Pago;
use DAO\GuardianDAO as guardianDAO;
use Models\Guardian as Guardian;
use Controllers\MascotasController as mascotasC;

class ReservasController{
    public $reservaDAO;

    function __construct()
    {
        $this->reservaDAO = new reservaDAO();
    }

    public function Add($fecha = '',$hora = '',$encuentro='',$dni_guardian='',$nombre_mascota=''){
        $reserva = new Reserva();
        $reserva->setFecha($fecha);
        $reserva->setHora($hora);
        $reserva->setEncuentro($encuentro);
        //$reserva->setId_reserva($id_reserva);
        $reserva->setEstado("pendiente");
        $reserva->setDniGuardian($dni_guardian);
        $user = new Duenio();
        $user = $_SESSION["loggeduser"];
        $reserva->setDniDuenio($user->getDni());
        $reserva->setNombre_mascota($nombre_mascota);

        $this->reservaDAO->Add($reserva);

        $guardianDAO = new guardianDAO();
        $guardian = $guardianDAO->getByDNI($dni_guardian);

        $mascotasC = new mascotasC();
        $pets = $mascotasC->getMascotasByDuenio();
        foreach($pets as $pet){
            if($pet->getNombre() == $nombre_mascota){
                $guardian->setDisponibilidad($fecha, $pet->getRaza());
            }
        }
        $guardianDAO->Update($guardian);
    }

    function reservarGuardian($dni){
        $guardian = new Guardian();
        $dao = new guardianDAO();
        $guardian = $dao->getByDNI($dni);
        include_once(VIEWS_PATH . "create-reserva.php");
    }

    function reservasPendientes($dni){
        $todas = $this->reservaDAO->getByDniUser($dni);
        $pendientes = array();
        foreach($todas as $res){
            if($res->getEstado() == "pendiente"){
                array_push($pendientes,$res);
            }
        }
        return $pendientes;
    }

    function programarReserva($res){
        $this->reservaDAO->updateEstado($res->getId_reserva(), "programada");
    }

    function rechazarReserva($res){
        $this->reservaDAO->updateEstado($res->getId_reserva(), "rechazada");
    }

}


?>