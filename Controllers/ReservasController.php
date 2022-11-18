<?php
namespace Controllers;
use DAO\ReservaDAO as reservaDAO;
use Models\Reserva as Reserva;
use Models\Duenio as Duenio;
use Models\Pago as Pago;
use DAO\GuardianDAO as guardianDAO;
use Models\Guardian as Guardian;
use Controllers\MascotasController as mascotasC;
use Controllers\UserController as userC;

class ReservasController{
    public $reservaDAO;

    function __construct()
    {
        $this->reservaDAO = new reservaDAO();
    }

    public function Add($fecha = '', $hora = '', $encuentro = '', $dni_guardian = '', $nombre_mascota = ''){
        $reserva = new Reserva();
        $reserva->setFecha($fecha);
        $reserva->setHora($hora);
        $reserva->setEncuentro($encuentro);

        $last_reserva = $this->reservaDAO->getLastReserva();

        if($last_reserva){
            //$last_id += 1;
            //$reserva->setId_reserva($last_id);
        }
        else {
            $reserva->setId_reserva(1);
        }

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

    function reservarGuardian($dni, $rango_d){
        $guardian = new Guardian();
        $dao = new guardianDAO();
        $guardian = $dao->getByDNI($dni);
        $petc = new mascotasC();
        $pets = $petc->getMascotasByDuenio();
        $arrayDisp = $guardian->getDisponibilidad();
        $array = array();

        $userC = new userC();
        $rango = $userC->arrayDate($rango_d);
    
        if(count($rango) > 1){
            $p = 0;
            $flag = false;
            while($flag == false && $p<count($pets)){ //recorre pets
                $array = array();
                foreach($rango as $r){
                    if($arrayDisp[$r]->getDisponibilidad() == "disponible" || $arrayDisp[$r]->getDisponibilidad() == $pets[$p]->getRaza()){
                        $array[$r] = $arrayDisp[$r];
                    }
                    else{
                        $flag = false;
                    }
                }
                if(count($array) == count($rango)){
                    $flag = true;
                }
                $p++;
            }
        }
        else{
            foreach($pets as $pet){
                foreach($arrayDisp as $fecha=>$disp){ 
                    if($disp == "disponible" or $disp == $pet->getRaza()){
                        $array[$fecha] = $disp;
                    }
                }
            }
        }
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

    function programarReserva($id_res){
        $this->reservaDAO->updateEstado($id_res, "programada");
    }

    function rechazarReserva($id_res){
        $this->reservaDAO->updateEstado($id_res, "rechazada");
    }

    function pendientes(){
        $reservas = $this->reservaDAO->getAll();
        $array = array();
        $estado = "Reservas pendientes";
        foreach($reservas as $res){
            if($res->getEstado() == "pendiente"){
                array_push($array, $res);
            }
        }
        include_once(VIEWS_PATH . 'show-reservas.php');
    }
  
    function programadas(){
        $reservas = $this->reservaDAO->getAll();
        $array = array();
        $estado = "Reservas programadas";
        foreach($reservas as $res){
            if($res->getEstado() == "programada"){
                array_push($array, $res);
            }
        }
        include_once(VIEWS_PATH . 'show-reservas.php');
    }
  
    function historial(){
        $reservas = $this->reservaDAO->getAll();
        $array = array();
        $estado = "Historial de reservas";
        foreach($reservas as $res){
            if($res->getEstado() == "servicio realizado"){
                array_push($array, $res);
            }
        }
        include_once(VIEWS_PATH . 'show-reservas.php');
    }



}




?>