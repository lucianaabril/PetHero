<?php
namespace Controllers;
use DAO\ReservaDAO as reservaDAO;
use Models\Reserva as Reserva;
use Models\Duenio as Duenio;
use Models\Pago as Pago;
use DAO\GuardianDAO as guardianDAO;
use Models\Guardian as Guardian;
use Controllers\MascotasController as mascotasC;
use DAO\MascotaDAO as mascotasDAO;
use Controllers\UserController as userC;
use Models\Cupon as cupon;
use Controllers\FileController as fileC;

class ReservasController{
    public $reservaDAO;

    function __construct()
    {
        $this->reservaDAO = new reservaDAO();
    }

    public function Add($fecha = '', $hora = '', $encuentro = '', $dni_guardian = '', $nombre_mascota = ''){
        
        $last_id = $this->reservaDAO->getLastId();
        $rango = explode(", ", $fecha);
        if($last_id){
            $last_id += 1;
        }
        else {
            $last_id = 1;
        }

        if(count($rango) > 1){
            foreach($rango as $r){
                $reserva = new Reserva();
                $reserva->setFecha($r);
                $reserva->setHora($hora);
                $reserva->setEncuentro($encuentro);
                $reserva->setEstado("pendiente");
                $reserva->setDniGuardian($dni_guardian);
                $user = new Duenio();
                $user = $_SESSION["loggeduser"];
                $reserva->setDniDuenio($user->getDni());
                $reserva->setNombre_mascota($nombre_mascota);
                $reserva->setId_reserva($last_id);
        
                $guardianDAO = new guardianDAO();
                $guardian = $guardianDAO->getByDNI($dni_guardian);

                $pago = new Pago();
                $pago->setMonto($guardian->getTarifa());
                $reserva->setPago($pago);
        
                $mascotasC = new mascotasC();
                $pets = $mascotasC->getMascotasByDuenio();
                foreach($pets as $pet){
                    if($pet->getNombre() == $nombre_mascota){
                        $guardian->setDisponibilidad($r, $pet->getRaza());
                    }
                }
                $guardianDAO->Update($guardian);
                $this->reservaDAO->Add($reserva);
            }
        }
        else{
            $reserva = new Reserva();
            $reserva->setFecha($fecha);
            $reserva->setHora($hora);
            $reserva->setEncuentro($encuentro);
            $reserva->setEstado("pendiente");
            $reserva->setDniGuardian($dni_guardian);
            $user = new Duenio();
            $user = $_SESSION["loggeduser"];
            $reserva->setDniDuenio($user->getDni());
            $reserva->setNombre_mascota($nombre_mascota);
            $reserva->setId_reserva($last_id);

            $guardianDAO = new guardianDAO();
            $guardian = $guardianDAO->getByDNI($dni_guardian);
            $pago = new Pago();
            $pago->setMonto($guardian->getTarifa());
            $reserva->setPago($pago);

            $this->reservaDAO->Add($reserva);
        }
    }

    function reservarGuardian($dni, $rango_d){
        $guardian = new Guardian();
        $dao = new guardianDAO();
        $guardian = $dao->getByDNI($dni);
        $petc = new mascotasC();
        $pets = $petc->getMascotasByDuenio();
        $arrayDisp = $guardian->getDisponibilidad();
        $arrayU = array(); //unica fecha
        $arrayR = array(); //rango

        $rango = explode(", ", $rango_d);
    
        if(count($rango) > 1){
            $p = 0;
            $flag = false;
            while($flag == false && $p<count($pets)){ //recorre pets
                $arrayR = array();
                foreach($rango as $r){
                    if(($arrayDisp[$r] == "disponible") or ($arrayDisp[$r] == $pets[$p]->getRaza())){
                        $arrayR[$r] = $arrayDisp[$r];
                    }
                    else{
                        $flag = false;
                    }
                }
                if(count($arrayR) == count($rango)){
                    $flag = true;
                }
                $p++;
            }
        }
        else{
            foreach($pets as $pet){
                foreach($arrayDisp as $fecha=>$disp){ 
                    if($disp == "disponible" or $disp == $pet->getRaza()){
                        $arrayU[$fecha] = $disp;
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

    function programarReserva($id_reserva){

        $reservas = $this->reservaDAO->getById($id_reserva);
        $dni_guardian = $reservas[0]->getDniGuardian();
        $dni_duenio = $reservas[0]->getDniDuenio();
        $nombre_mascota = $reservas[0]->getNombre_mascota();
        $fecha = $reservas[0]->getFecha();

        $mascotasDAO = new mascotasDAO();
        $mascotas = $mascotasDAO->getByDniDuenio($dni_duenio);
        foreach($mascotas as $m){
            if($m->getNombre() == $nombre_mascota){
                $raza = $m->getRaza();
            }
        }

        $guardianDAO = new guardianDAO();
        $guardian = $guardianDAO->getByDni($dni_guardian);
        $disp = $guardian->getDisponibilidad();

        if($disp[$fecha] == 'disponible' || $disp[$fecha] == $raza){
            foreach($reservas as $r){
                $disp[$r->getFecha()] = $raza;
            }
            $guardian->newDisponibilidad($disp);
            $guardianDAO = new guardianDAO();
            $guardianDAO->Update($guardian);
    
            $this->reservaDAO->updateEstado($id_reserva, "programada");
        } 
        else{
            echo "Esta fecha se encuentra programada para otro tipo de raza.";
        }
    }

    function rechazarReserva($id_reserva){
        $this->reservaDAO->updateEstado($id_reserva, "rechazada");
    }

    function pendientes(){
        $reservas = $this->reservaDAO->getAll();
        $array = array();
        $estado = "Reservas pendientes";
        $user = new userC;
        $user = $_SESSION['loggeduser'];

        if($user->getType() == 'G'){
            foreach($reservas as $r){
                if($r->getEstado() == "pendiente"){
                    if($r->getDniGuardian() == $user->getDni()){
                        $aux = array();
                        if(array_key_exists($r->getId_reserva(), $array)){
                            $aux = $array[$r->getId_reserva()];
                        }
                        array_push($aux, $r);
                        $array[$r->getId_reserva()] = $aux;
                    }
                }
            }
            include_once(VIEWS_PATH . 'admin-reservas.php'); //view para guardian = aceptar/rechazar
        }
        else {
            foreach($reservas as $r){
                if($r->getEstado() == "pendiente"){
                    if($r->getDniDuenio() == $user->getDni()){
                        array_push($array, $r);
                    }
                }
            }
            include_once(VIEWS_PATH . 'show-reservas.php');
        }
    }
  
    function programadas(){
        $reservas = $this->reservaDAO->getAll();
        $array = array();
        $estado = "Reservas pendientes";
        $user = new userC;
        $user = $_SESSION['loggeduser'];

        if($user->getType() == 'G'){
            foreach($reservas as $r){
                if($r->getEstado() == "programada"){
                    if($r->getDniGuardian() == $user->getDni()){
                        array_push($array, $r);
                    }
                }
            }
            include_once(VIEWS_PATH . 'show-reservas.php');
        }
        else {
            foreach($reservas as $r){
                if($r->getEstado() == "programada"){
                    if($r->getDniDuenio() == $user->getDni()){
                        $aux = array();
                        if($array){
                            if(array_key_exists($r->getId_reserva(), $array)){
                                $aux = $array[$r->getId_reserva()];
                            }
                        }
                        array_push($aux, $r);
                        $array[$r->getId_reserva()] = $aux;
                    }
                }
            }
            include_once(VIEWS_PATH . 'pagar-reservas.php');
        }
    }
  
    function historial(){
        $reservas = $this->reservaDAO->getAll();
        $array = array();
        $estado = "Historial de reservas";
        $user = new userC;
        $user = $_SESSION['loggeduser'];

        if($user->getType() == 'G'){
            foreach($reservas as $r){
                if($r->getEstado() == "servicio realizado"){
                    if($r->getDniGuardian() == $user->getDni()){
                        array_push($array, $r);
                    }
                }
            }
        }
        else {
            foreach($reservas as $r){
                if($r->getEstado() == "servicio realizado"){
                    if($r->getDniDuenio() == $user->getDni()){
                        array_push($array, $r);
                    }
                }
            }
        }
        include_once(VIEWS_PATH . 'show-reservas.php');
    }

    public function pagar($id_reserva = '', $dni_guardian = '')
    {
      $id = $id_reserva;
      $dni = $dni_guardian;
      include_once(VIEWS_PATH . 'metodo-pago.php'); 
    }

    public function metodoPago($id_reserva = '', $metodo_pago = '', $dni_guardian = ''){
        $id = $id_reserva;
        $monto_total = 0;
        $reservas = $this->reservaDAO->getById($id_reserva);
        foreach($reservas as $r){
            $monto_total += $r->pago->getMonto();
        }

        if($metodo_pago == "tarjeta"){
            include_once(VIEWS_PATH . 'tarjeta.php');
        } else
        {
            $guardianDAO = new guardianDAO();
            $guardian = $guardianDAO->getByDNI($dni_guardian);
            include_once(VIEWS_PATH . 'mercado-pago.php');
        }
    }

    public function tarjeta($tipo_tarjeta = '', $numero_tarjeta = '', $seguridad = '', $vencimiento = '', $id_reserva = '', $monto_total = ''){
        $reservas = $this->reservaDAO->getById($id_reserva);
        foreach($reservas as $r){
            $r->pago->setFecha(date('Y-m-d'));
            $r->pago->setForma_pago("tarjeta");
            $this->reservaDAO->Update($id_reserva, $r->getFecha(), $r);
        }
        $cupon = new cupon();
        $cupon->setFecha(date('Y-m-d'));
        $cupon->setMonto($monto_total);
        $detalles = "Tipo de tarjeta: " . $tipo_tarjeta . "<br>" . "Numero de tarjeta: " . $numero_tarjeta . "<br>" . "Código de seguridad: " . $seguridad . "<br>" . "Vencimiento de la tarjeta: " . $vencimiento;
        $cupon->setDetalles($detalles);

        include_once(VIEWS_PATH . 'cupon.php');
    }

    public function uploadComprobante($comprobante){
        $controller = new fileC();
        $c = $controller->upload();
        
    }





}
?>