<?php

namespace Controllers;
use Models\Guardian as Guardian;
use DataBase\GuardianDAO as GuardianDAO;
use DataBase\DuenioDAO as DuenioDAO;
use Models\Duenio as Duenio;
use Controllers\MascotasController as MascotasController;
use Controllers\ReservasController as ResC;
use DateTime as DateTime;
use DatePeriod as DatePeriod;
use DateInterval as DateInterval;
use FFI\Exception as Exception;
use DataBase\CuponDAO as cuponDAO;
use DataBase\ReservaDAO as reservaDAO;

class UserController
{
  private $guardianDAO;
  private $duenioDAO;

  function __construct()
  {
    $this->guardianDAO = new GuardianDAO();
    $this->duenioDAO = new DuenioDAO();
  }

  public function showDisponibilidadView()
  {
    require_once(VIEWS_PATH . 'disponibilidad.php');
  }

  public function changeDisponibilidad($inicio = '', $fin = '')
  {
    try{
      if (isset($_SESSION['email'])) {
        $guardian = new Guardian();
        $guardian = $this->guardianDAO->getByEmail($_SESSION['email']);
  
        if ($inicio != '' && $fin != '') {
          $rango = $this->rangeDate($inicio, $fin);
          foreach ($rango as $fecha) {
            $guardian->setDisponibilidad($fecha, "disponible");
          }
          $this->guardianDAO->Update($guardian);
          require_once(VIEWS_PATH . 'guardian-page.php');
        } else {
          echo "Debe ingresar un rango de fechas";
        }
      } else {
        require_once(VIEWS_PATH . 'login.php');
      }
    }
    catch(Exception $ex){
      throw $ex;
    }
  }

  public function showGuardianDataView()
  {
    require_once(VIEWS_PATH . "guardian-data.php");
  }

  public function changeGuardianData($tarifa = '', $preferencia = '')
  {
    try{
      if (isset($_SESSION['email'])) {
        $guardian = new Guardian();
        $guardian = $this->guardianDAO->getByEmail($_SESSION['email']);
  
        if ($tarifa != '') {
          $guardian->setTarifa($tarifa);
        }
  
        if ($preferencia != '') {
          $guardian->setPreferencia($preferencia);
        }
  
        $this->guardianDAO->Update($guardian);
        require_once(VIEWS_PATH . 'guardian-page.php');
      } else {
        require_once(VIEWS_PATH . 'login.php');
      }
    }
    catch(Exception $ex){
      throw $ex;
    }
  }

  public function showUserDataView()
  {
    require_once(VIEWS_PATH . "user-data.php");
  }

  public function ShowSignupView()
  {
    require_once(VIEWS_PATH . "signup.php");
  }

  public function ShowLoginView()
  {
    require_once(VIEWS_PATH . "login.php");
  }

  public function login($email, $password)
  {
    if ($email == "" or $password == "") {
      require_once(VIEWS_PATH . "login.php");
    }
    else
    {
      try
      {
        $duenio = new Duenio();
        $duenio = $this->duenioDAO->getByEmail($email);
        $guardian = new Guardian();
        $guardian = $this->guardianDAO->getByEmail($email);
        if ($guardian != null) {
          if ($guardian->getPassword() == $password) {
            $_SESSION['loggeduser'] = $guardian;
            $_SESSION['email'] = $guardian->getEmail();
            $_SESSION['type'] = $guardian->getType();
            $this->showView($_SESSION['type']);
          }
          else
          {
            require_once(VIEWS_PATH . 'login.php');
          }
        }
        else
        {
          if ($duenio != null) {
            if ($duenio->getPassword() == $password) {
              $_SESSION['loggeduser'] = $duenio;
              $_SESSION['email'] = $duenio->getEmail();
              $_SESSION['type'] = $duenio->getType();
              $this->showView($_SESSION['type']);
            }
            else
            {
              require_once(VIEWS_PATH . 'login.php');
            }
          }
        }
      }
      catch(Exception $ex){
        throw $ex;
      }
    }
  }

  public function logout()
  {
    session_destroy();
    header("location: " . FRONT_ROOT . "User/ShowLoginView");
  }

  public function validar($email, $password, $type, $nombre, $apellido, $dni, $telefono, $direccion, $cumpleanios, $disponibilidad, $tarifa, $preferencia)
  {
    if (ctype_alpha($nombre) == false) {
      echo "El formato ingresado para el nombre es incorrecto.";
      return false;
    }
    if (ctype_alpha($apellido) == false) {
      echo "El formato ingresado para el apellido es incorrecto.";
      return false;
    }
    if (ctype_digit($dni) == false) {
      echo "El formato ingresado para el dni es incorrecto.";
      return false;
    }
    if (strlen($dni) > 8) {
      echo "El formato ingresado para el dni es incorrecto.";
      return false;
    }
    if (ctype_digit($telefono) == false) {
      echo "El formato ingresado para el tel??fono es incorrecto.";
      return false;
    }
    $hoy = date_create('now');
    $cumpleaniosD = date_create($cumpleanios);
    $diff = date_diff($cumpleaniosD, $hoy);
    if (($diff->format("%R%a") / 365) < 18) {
      echo "Para registrarse hay que ser mayor de edad.";
      return false;
    }
    return true;
    echo "";
  }

  public function Add($email = '', $password = '', $type = '', $nombre = '', $apellido = '', $dni = '', $telefono = '', $direccion = '', $cumpleanios = '', $disponibilidad = '', $tarifa = '', $preferencia = '')
  {
    try{
      if ($this->validar($email, $password, $type, $nombre, $apellido, $dni, $telefono, $direccion, $cumpleanios, $disponibilidad, $tarifa, $preferencia)) {

        if ($_POST['type'] == 'G') {
          $guardian = new Guardian();
          $guardian->setEmail($email);
          $guardian->setPassword($password);
          $guardian->setType($type);
  
          $guardian->setNombre($nombre);
          $guardian->setApellido($apellido);
          $guardian->setDni($dni);
          $guardian->setTelefono($telefono);
          $guardian->setDireccion($direccion);
          $guardian->setCumpleanios($cumpleanios);
          $guardian->setDisponibilidad(null, null, 'disponible');
          $guardian->setTarifa(null);
          $guardian->setPreferencia(null);
          $guardian->setCBU(null);
          $guardian->setAlias(null);
  
          $this->guardianDAO->Add($guardian);
  
          require_once(VIEWS_PATH . 'login.php');
        } elseif ($_POST['type'] == 'D'){
          $duenio = new Duenio();
          $duenio->setEmail($email);
          $duenio->setPassword($password);
          $duenio->setType($type);
          $duenio->setNombre($nombre);
          $duenio->setApellido($apellido);
          $duenio->setDni($dni);
          $duenio->setTelefono($telefono);
          $duenio->setDireccion($direccion);
          $duenio->setCumpleanios($cumpleanios);
  
          $this->duenioDAO->Add($duenio);
  
          require_once(VIEWS_PATH . 'login.php');
        }
      } else {
        $this->ShowSignupView();
      }
    }
    catch(Exception $ex){
      throw $ex;
    }
  }

  public function showViewGuardianesAsDuenio()
  {
    require_once(VIEWS_PATH . "view-guardianes.php");
  }

  public function viewGuardianesAsDuenio()
  {
    try{
      $petController = new MascotasController();
      $user = new Duenio();
      $user = $_SESSION["loggeduser"];
      $pets = $petController->getMascotasByDuenio($user->getDni());
      $guardianDAO = new GuardianDAO();
      $guardianes = $guardianDAO->GetAll();
      $array = array();
      $flag = false;
  
      foreach ($pets as $pet) {
        foreach ($guardianes as $guardian) {
          if ($pet->getTamanio() == $guardian->getPreferencia()) {
            if ($array) {
              foreach ($array as $g) {
                if ($g->getDni() == $guardian->getDni()) {
                  $flag = true;
                }
              }
              if (!$flag) {
                array_push($array, $guardian);
              }
            } else {
              array_push($array, $guardian);
            }
          }
        }
      }
      return $array;
    }
    catch(Exception $ex){
      throw $ex;
    }
  }

  public function showGuardianesDispView()
  {
    require_once(VIEWS_PATH . 'view-guardianes-disp.php');
  }

  public function realizarReserva($dni = '', $rango_d = '')
  {
    $reservasC = new ResC();
    $reservasC->reservarGuardian($dni, $rango_d);
  }

  public function showFiltrarFechaView()
  {
    require_once(VIEWS_PATH . 'filtrar-fecha.php');
  }

  public function filtrarFecha($inicio = '', $fin = '')
  { 
    if ($inicio == '' && $fin == '') {                          
      $ex = new Exception("Debe ingresar fechas para continuar. ");
      throw $ex;
    }
    elseif($inicio < date('Y-m-d')) {
      $ex = new Exception("La(s) fecha(s) ingresadas son inv??lidas, ingreselas nuevamente. ");
      throw $ex;
    }
    else{
      $petController = new MascotasController();
      $user = new Duenio();
      $user = $_SESSION["loggeduser"];
      $pets = $petController->getMascotasByDuenio($user->getDni());

      $guardianDAO = new GuardianDAO();
      $guardianes = $guardianDAO->getAll();
      $arrayD = array();
      $flag = false;
      $fecha = 0;
      $rango = array();

      if ($inicio != '' && $fin != '') { //si ingres?? un rango
        $rango = $this->rangeDate($inicio, $fin);

        foreach ($pets as $pet) {
          foreach ($guardianes as $guardian) {
            if ($pet->getTamanio() == $guardian->getPreferencia()) {
              if ($arrayD) {
                foreach ($arrayD as $g) {
                  if ($g->getDni() == $guardian->getDni()) {
                    $flag = true; //el guardian ya se mostr??
                  }
                }
              }

              if(!$flag){
                $disponibilidad = $guardian->getDisponibilidad();
                $i = 0;
                foreach($rango as $r){
                  if(array_key_exists($r, $disponibilidad)){
                    $i++;
                  }
                }
              }

              if($i == count($rango)){
                array_push($arrayD, $guardian);
              }

              $i = 0;
              $flag = false;
            }
          }
        }
        include(VIEWS_PATH . 'view-guardianes-disp.php');

      } elseif ($inicio == '' xor $fin == '') { // si ingres?? una sola fecha
        if ($inicio) {
          $fecha_ingresada = $inicio;
        } else {
          $fecha_ingresada = $fin;
        }

        foreach ($pets as $pet) {
          foreach ($guardianes as $guardian) {
            if ($pet->getTamanio() == $guardian->getPreferencia()) {
              if ($arrayD) {
                foreach ($arrayD as $g) {
                  if ($g->getDni() == $guardian->getDni()) {
                    $flag = true; //el guardian ya se mostr??
                  }
                }
              }

              if (!$flag) {
                $disponibilidad = $guardian->getDisponibilidad();
                foreach ($disponibilidad as $fecha => $disp) {
                  if ($fecha_ingresada == $fecha) {
                    array_push($arrayD, $guardian);
                  }
                }
              }
            }
            $flag = false;
          }
        }
        include(VIEWS_PATH . 'view-guardianes-disp.php');
      }
      
    }
  }

  public function showView($type)
  {
    if ($type == 'G') {
      require_once(VIEWS_PATH . "guardian-page.php");
    } else {
      require_once(VIEWS_PATH . "duenio-page.php");
    }
  }

  public function getView()
  {
    $type = $this->getUserType();
    if ($type == 'g') {
      require_once(VIEWS_PATH . "guardian-page.php");
    }
    if ($type == 'd') {
      require_once(VIEWS_PATH . "duenio-page.php");
    }
  }

  public function showPerfil()
  {
    require_once(VIEWS_PATH . "perfil.php");
  }

  public function getUserType()
  {
    if ($_SESSION['type'] == 'G') {
      return 'g';
    } else {
      return 'd';
    }
  }

  public function showMascotas()
  {
    require_once(VIEWS_PATH . "show-mascotas.php");
  }

  public function processReserva($dniGuardian = '', $disponibilidad = '', $preferencia = '', $fecha = '')
  {
    $dni_guardian = $dniGuardian;
    $disp = $disponibilidad;
    $pref = $preferencia;
    $date = $fecha;

    $petc = new MascotasController();
    $pets = $petc->getMascotasByDuenio();
    $cont = 0;
    $arrayPos = array();
    foreach($pets as $pet){
      if($pref == $pet->getTamanio()){
          if($disp == "disponible" or $disp == $pet->getRaza()){
              array_push($arrayPos,$cont);
          }
      }
      $cont++;
    }
    include_once(VIEWS_PATH . "add-reserva.php");
  }

  public function agregarReserva($fecha = '', $hora = '', $encuentro = '', $dni_guardian = '', $nombre_mascota = '')
  {
    $controller = new ResC();
    $controller->Add($fecha, $hora, $encuentro, $dni_guardian, $nombre_mascota);
    require_once(VIEWS_PATH . 'duenio-page.php');
  }

  public function rangeDate($inicio, $final){
    $ini = DateTime::createFromFormat('Y-m-d', $inicio);
    $fin = DateTime::createFromFormat('Y-m-d', $final);
    $periodo = new DatePeriod(
      $ini,
      new DateInterval('P1D'),
      $fin,
    );

    $rango = [];
    foreach ($periodo as $date) {
      $rango[] = $date->format('Y-m-d');
    }
    $rango[] = $final;
    return $rango;
  }

  public function showReservas()
  {
    try{
      $user = $_SESSION['loggeduser'];
      $dni = $user->getDni();
      $controller = new ResC();
      $reservas = $controller->reservaDAO->GetAll();
      $array = array();
      foreach ($reservas as $res) {
        if ($dni == $res->getDniDuenio()) {
          array_push($array, $res);
        }
      }
      include_once(VIEWS_PATH . 'show-reservas-d.php');
    }
    catch(Exception $ex){
      throw $ex;
    }
  }

  public function changeDatos($cbu = '', $alias = ''){
    try{
      if (isset($_SESSION['email'])) {
        $guardian = new Guardian();
        $guardian = $this->guardianDAO->getByEmail($_SESSION['email']);
  
        if ($cbu != '') {
          $guardian->setCBU($cbu);
        }
  
        if ($alias != '') {
          $guardian->setAlias($alias);
        }
        $this->guardianDAO->Update($guardian);
  
        require_once(VIEWS_PATH . 'guardian-page.php');
      } else {
        require_once(VIEWS_PATH . 'login.php');
      }
    }
    catch(Exception $ex){
      throw $ex;
    }
  }

  public function cuponesView(){
    try{
      $user = $_SESSION['loggeduser'];
      $cuponDAO = new cuponDAO();
      $cupones = $cuponDAO->GetAll();
      $array = array();
  
      $reservaDAO = new reservaDAO();
      foreach($cupones as $c){
        $reserva = $reservaDAO->getById($c->getId_reserva());
        if($reserva[0]->getDniDuenio() == $user->getDni()){
          array_push($array, $c);
        }
      }
      include_once(VIEWS_PATH . 'cupones.php');
    }
    catch(Exception $ex){
      throw $ex;
    }
  }


}
