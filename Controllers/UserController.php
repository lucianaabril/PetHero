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

    public function showGuardianDataView(){
      require_once(VIEWS_PATH . "guardian-data.php");
    }

    public function changeGuardianData($inicio = '', $final = '', $tarifa = '', $preferencia = ''){
      if(isset($_SESSION['email'])){
          $guardian = new Guardian();
          $guardian = $this->guardianDAO->getByEmail($_SESSION['email']);
          if($inicio != '' && $final != ''){
            $guardian->setDisponibilidad($inicio, $final);
          }
          
          if($tarifa != ''){
            $guardian->setTarifa($tarifa);
          }
          
          if($preferencia != ''){
            $guardian->setPreferencia($preferencia);
          }
          $this->guardianDAO->Update($guardian);
      }
      else{
        require_once(VIEWS_PATH.'login.php');
      }
    }

    public function showUserDataView(){
        require_once(VIEWS_PATH . "user-data.php");
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
                $this->showView($_SESSION['type']);
              }
              else{
                $this->ShowLoginView();
              }
        }
        else{
          if($duenio != null){
            if ($duenio->getPassword() == $password) {
              $_SESSION['loggeduser'] = $duenio;
              $_SESSION['email'] = $duenio->getEmail();
              $_SESSION['type'] = $duenio->getType();
              $this->showView($_SESSION['type']);
            }
            else{
              $this->ShowLoginView();
            }
          }
          else{
            $this->ShowLoginView();
          }
        }
      }
    }

    public function logout(){
      session_destroy();
      header("location: ".FRONT_ROOT."User/ShowLoginView");
    }

    public function Add($email = '', $password = '', $type = '', $nombre = '', $apellido = '', $dni = '', $telefono = '', $direccion = '', $cumpleanios = '', $disponibilidad = '', $tarifa = '', $preferencia = '')
    {
      if($_POST['type'] == 'G') {
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
      }              
      elseif($_POST['type'] == 'D') {          
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
    }

    public function showView($type){
      if($type == 'G'){
        require_once(VIEWS_PATH."guardian-page.php");
      }
      else{
        require_once(VIEWS_PATH."duenio-page.php");
      }
    }

    public function showPerfil(){
      if($_SESSION['type'] == 'G'){
        $guardian = $this->guardianDAO->getByEmail($_SESSION['email']); ?> <html> <br> </html> <?php
        echo "Nombre: ".$guardian->getNombre(); ?> <html> <br> </html> <?php
        echo "Apellido: ".$guardian->getApellido(); ?> <html> <br> </html> <?php
        echo "DNI: ".$guardian->getDni(); ?> <html> <br> </html> <?php
        echo "Teléfono: ".$guardian->getTelefono(); ?> <html> <br> </html> <?php
        echo "Dirección: ".$guardian->getDireccion(); ?> <html> <br> </html> <?php
        echo "Fecha de nacimiento: ".$guardian->getCumpleanios(); ?> <html> <br> </html> <?php
        $disp = $guardian->getDisponibilidad();
        echo "Disponibilidad: ". $disp[0] . " / " . $disp[1]; ?> <html> <br> </html> <?php
        echo "Tarifa: $".$guardian->getTarifa(); ?> <html> <br> </html> <?php
        echo "Preferencia tamaño de perro: ".$guardian->getPreferencia(); ?> <html> <br> </html> <?php
      }
      else{
        $duenio = $this->duenioDAO->getByEmail($_SESSION['email']); ?> <html> <br> </html> <?php
        echo "Nombre: ".$duenio->getNombre(); ?> <html> <br> </html> <?php
        echo "Apellido: ".$duenio->getApellido(); ?> <html> <br> </html> <?php
        echo "DNI: ".$duenio->getDni(); ?> <html> <br> </html> <?php
        echo "Teléfono: ".$duenio->getTelefono(); ?> <html> <br> </html> <?php
        echo "Dirección: ".$duenio->getDireccion(); ?> <html> <br> </html> <?php
        echo "Fecha de nacimiento: ".$duenio->getCumpleanios(); ?> <html> <br> </html> <?php
      }
    }
  }
?>
