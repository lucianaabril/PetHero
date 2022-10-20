<?php
    namespace Controllers;
  
    use Models\Guardian as Guardian;
    use DAO\GuardianDAO as GuardianDAO;
    use Models\Duenio as Duenio;
    use DAO\DuenioDAO as DuenioDAO;

    class UserController
    {
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
                require_once(VIEWS_PATH.'guardian-add.php');
              }
            }
            else {
              require_once(VIEWS_PATH.'guardian-list.php');
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
                require_once(VIEWS_PATH.'duenio-add.php');
              }
            }
            else {
              require_once(VIEWS_PATH.'duenio-list.php');
            }
        }
        else{
            require_once(VIEWS_PATH.'login.php');}
      }

      public function showView($type){
        if($type == 'G'){
          require_once(VIEWS_PATH.'guardian-page');
        }
        else{
          require_once(VIEWS_PATH.'duenio-page');
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