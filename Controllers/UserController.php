<?php
    namespace Controllers;

    use Models\Duenio as Duenio;
    use Models\Guardian as Guardian;
    use DAO\GuardianDAO as GuardianDAO;
    use DAO\DuenioDAO as DuenioDAO;

    class UserController
    {
      private $guardianDAO;
      private $duenioDAO;

      function __construct(){
        $this->guardianDAO = new GuardianDAO();
        $this->duenioDAO = new DuenioDAO();
      }

      public function ShowSignupView(){
        require_once(VIEWS_PATH . "signup.php");
      }

      public function ShowLoginView(){
        require_once(VIEWS_PATH . "login.php");
      }

      public function login($email, $password){
          if($email == "" or $password == ""){
              require_once(VIEWS_PATH."login.php");
          }
          else{
              $duenio = new Duenio();
              $duenio = $this->duenioDAO->getByEmail($email);

              $guardian = new Guardian();
              $guardian = $this->guardianDAO->getByEmail($email);

              if($guardian != null){
                  if($guardian->getPassword() == $password){
                      $_SESSION['loggeduser'] = $guardian;
                      $_SESSION['email'] = $guardian->getEmail();
                      $_SESSION['type'] = $guardian->getType();
                      $this->showView('G');
                  }
                  else{
                      require_once(VIEWS_PATH. 'login.php');
                  }
              }
              else{
                  if($duenio != null){
                  if ($duenio->getPassword() == $password) {
                      $_SESSION['loggeduser'] = $duenio;
                      $_SESSION['email'] = $duenio->getEmail();
                      $_SESSION['type'] = $duenio->getType();
                      $this->showView('D');
                  }
                  else{
                      require_once(VIEWS_PATH.'login.php');
                  }
                  }
              }
          }
      }

      public function logout(){
          session_destroy();
          header("location: ".FRONT_ROOT."User/ShowLoginView");
      }

      public function Add($email = '', $type = '', $nombre = '', $apellido = '', $telefono = '', $password = '', $dni = '', $cuil = '', $disponibilidad = '', $tarifa = '', $direccion = '')
      {
        if(isset($_SESSION['email'])){
          if($_SESSION['type'] == 'G') {
            if($email != '' || $type != '' || $nombre != '' || $apellido != ''|| $telefono != ''  || $direccion != ''|| $password != '' || $cuil != '' || $disponibilidad != '' || $tarifa != '') {
                
              $guardian = new Guardian();
                
              $guardian->setNombre($nombre);
              $guardian->setApellido($apellido);
              $guardian->setCuil($cuil);
              $guardian->setTelefono($telefono);
              $guardian->setDireccion($direccion);
              $guardian->setDisponibilidad($disponibilidad);
              $guardian->setTarifa($tarifa);
              $guardian->setEmail($email);
              $guardian->setPassword($password);
              $guardianDAO = new GuardianDAO();
              $guardianDAO->Add($guardian);
              
              $this->showView($type);
            }              
            else 
            {
              header("location: ".FRONT_ROOT."User/ShowSignupView");
            }
          }
          else {
            require_once(VIEWS_PATH.'guardian-list.php'); /*??????????????*/
          }

          if($_SESSION['type'] == 'D') {
            if($email != '' || $type != '' || $nombre != '' || $apellido != ''|| $telefono != '' || $password != '' || $dni != '') {
              $duenio = new Duenio($nombre, $apellido, $telefono, $direccion, $dni);
              $duenio->setEmail($email);
              $duenio->setPassword($password);
              
              $duenioDAO = new DuenioDAO();
              $duenioDAO->Add($duenio);
              
              $this->showView($type);
            }              
            else 
            {
              header("location: ".FRONT_ROOT."User/ShowSignupView");
            }
          }
          else {
            require_once(VIEWS_PATH.'duenio-list.php'); /*??????????????*/
          }
        }
        else{
          header("location: ".FRONT_ROOT."User/ShowSignupView");
        }
      }

      public function showView($type){
        if($type == 'G'){
            require_once(VIEWS_PATH."guardian-page.php");
        }
        else{
            require_once(VIEWS_PATH."duenio-page.php");
        }
    }

      /*  public function List($mensaje = '')
        {
          if(isset($_SESSION['email'])) {
            $duenioDAO = new DuenioDAO();
            $guardianDAO = new GuardianDAO();
            $lista = array();
            if($_SESSION['type'] == 'G') {
              $lista = $guardianDAO->GetAll();
            }              
            else
            { 
              $lista = $duenioDAO->GetAll();
            }
          }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        */

        /*public function Update($id, $estado = '') {
          if(isset($_SESSION['user'])){
            if($_SESSION['type'] == 'T') {
              if($estado != '') {                
                $serviceDao = new ServiceDAO();
                $serviceDao->UpdateEstado($id, $estado);
                
                $this->List('El registro fue actualizado');
              }              
              else 
              {
                $serviceDao = new ServiceDAO();
                $service = $serviceDao->getById($id);
                require_once(VIEWS_PATH.'service-update.php');
              }
            }
            else {
              require_once(VIEWS_PATH.'service-list.php');
            }
        }else
            require_once(VIEWS_PATH.'login.php');
        }
        */

        /*

        public function Delete($id) {
          if(isset($_SESSION['user'])){
            if($_SESSION['type'] == 'T') {
                $serviceDao = new ServiceDAO();
                $serviceDao->Delete($id);                
                $this->List('El registro fue eliminado');
            }
            else {
              require_once(VIEWS_PATH.'service-list.php');
            }
          }else
            require_once(VIEWS_PATH.'login.php');
        }
        */
    
    }

    ?>