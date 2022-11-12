<?php
    namespace Controllers;

    use Models\Duenio as Duenio;
    use Models\Guardian as Guardian;
    use DAO\GuardianDAO as GuardianDAO;
    use DAO\DuenioDAO as DuenioDAO;
    use Controllers\MascotasController as MascotasController;
    class UserController
    {
      private $guardianDAO;
      private $duenioDAO;
    
      function __construct()
      {
        $this->guardianDAO = new GuardianDAO();
        $this->duenioDAO = new DuenioDAO();
      }

      public function showDisponibilidadView(){
        require_once(VIEWS_PATH . 'disponibilidad.php');
      }

      public function changeDisponibilidad($fecha = '')
      {
        if (isset($_SESSION['email'])) {
          $guardian = new Guardian();
          $guardian = $this->guardianDAO->getByEmail($_SESSION['email']);
          if ($fecha != '') {
            $guardian->setDisponibilidad($fecha);
            $this->guardianDAO->Update($guardian);
            require_once(VIEWS_PATH . 'guardian-page.php');
          }
          else {
            echo "Debe ingresar una fecha";
          }
        }
        else {
          require_once(VIEWS_PATH . 'login.php');
        }
      }
    
      public function showGuardianDataView()
      {
        require_once(VIEWS_PATH . "guardian-data.php");
      }
    
      public function changeGuardianData($tarifa = '', $preferencia = '')
      {
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
        } else {
          require_once(VIEWS_PATH . 'login.php');
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
        } else {
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
            } else {
              require_once(VIEWS_PATH . 'login.php');
            }
          } else {
            if ($duenio != null) {
              if ($duenio->getPassword() == $password) {
                $_SESSION['loggeduser'] = $duenio;
                $_SESSION['email'] = $duenio->getEmail();
                $_SESSION['type'] = $duenio->getType();
                $this->showView($_SESSION['type']);
              } else {
                require_once(VIEWS_PATH . 'login.php');
              }
            }
          }
        }
      }
    
      public function logout()
      {
        session_destroy();
        header("location: " . FRONT_ROOT . "User/ShowLoginView");
      }
    
      public function validar($email,$password,$type,$nombre,$apellido,$dni,$telefono,$direccion,$cumpleanios,$disponibilidad,$tarifa,$preferencia)
      {
        if (ctype_alpha($nombre) == false) {
          echo "El formato ingresado para el nombre es incorrecto.";
          return false;
        }
        if(ctype_alpha($apellido) == false){
          echo "El formato ingresado para el apellido es incorrecto.";
          return false;
        }
        if(ctype_digit($dni) == false) {
          echo "El formato ingresado para el dni es incorrecto.";
          return false;
        }
        if(strlen($dni) > 8){
          echo "El formato ingresado para el dni es incorrecto.";
          return false;
        }
        if(ctype_digit($telefono) == false) {
          echo "El formato ingresado para el teléfono es incorrecto.";
          return false;
        }
        $hoy = date_create('now');
        $cumpleaniosD = date_create($cumpleanios);
        $diff = date_diff($cumpleaniosD,$hoy);
        if(($diff->format("%R%a") / 365) < 18){
          echo "Para registrarse hay que ser mayor de edad.";
          return false;
        }
        return true;
        echo "";
      }
    
      public function Add($email = '', $password = '', $type = '', $nombre = '', $apellido = '', $dni = '', $telefono = '', $direccion = '', $cumpleanios = '', $disponibilidad = '', $tarifa = '', $preferencia = '')
      {
        
        if ($this->validar($email,$password,$type,$nombre,$apellido,$dni,$telefono,$direccion,$cumpleanios,$disponibilidad,$tarifa,$preferencia)) {
          
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
            $guardian->setDisponibilidad(null, null);
            $guardian->setTarifa(null);
            $guardian->setPreferencia(null);
    
            $this->guardianDAO->Add($guardian);
    
            require_once(VIEWS_PATH . 'login.php');
          } elseif ($_POST['type'] == 'D') {
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

      public function viewGuardianesAsDuenio(){
        $petController = new MascotasController();
        $user = new Duenio();
        $user = $_SESSION["loggeduser"];
        $pets = $petController->getMascotasByDuenio($user->getDni());
        $guardianDAO = new GuardianDAO();
        $guardianes = $guardianDAO->GetAll();

        foreach($pets as $pet){
          foreach($guardianes as $guardian){
            if($pet->getTamanio() == $guardian->getPreferencia()){
              $guardian->showGuardian();
            }
          }
        }
      }

      public function showFiltrarFechaView(){
        require_once(VIEWS_PATH . 'filtrar-fecha.php');
      }

      public function filtrarFecha($fecha = ''){
        if($fecha != '')
        {
          $petController = new MascotasController();
          $user = new Duenio();
          $user = $_SESSION["loggeduser"];
          $pets = $petController->getMascotasByDuenio($user->getDni());

          $guardianDAO = new GuardianDAO();
          $guardianes = $guardianDAO->getAll();

          foreach($pets as $pet){
            foreach($guardianes as $guardian){
              if($pet->getTamanio() == $guardian->getPreferencia()){
                $fechas = $guardian->getDisponibilidad();
                foreach($fechas as $fecha_disp){
                  if($fecha == $fecha_disp){
                    $cont = true;
                  }
                }
                if($cont == true){
                  $guardian->showGuardian();
                  $cont = false;
                }
              }
            }
          }
        } else {
          echo "Debe ingresar una fecha";
        }
      }

      public function showViewGuardianesAsDuenio(){
        require_once(VIEWS_PATH . "view-guardianes.php");
      }
    
      public function showView($type)
      {
        if ($type == 'G') {
          require_once(VIEWS_PATH . "guardian-page.php");
        } else {
          require_once(VIEWS_PATH . "duenio-page.php");
        }
      }

      public function getView(){
        $type = $this->getUserType();
        if($type == 'g'){
          require_once(VIEWS_PATH . "guardian-page.php");
        }
        if($type == 'd'){
          require_once(VIEWS_PATH . "duenio-page.php");
        }
      }

      public function showPerfil(){
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

      public function showMascotas(){
        require_once(VIEWS_PATH . "show-mascotas.php");
      }
}
