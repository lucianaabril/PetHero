<?php
    namespace Controllers;
    use Models\Duenio as Duenio;
    use Models\Guardian as Guardian;
    use DAO\GuardianDAO as GuardianDAO;
    use DAO\DuenioDAO as DuenioDAO;
    use Controllers\UserController as UserController;

    class AuthController{
        private $guardianDAO;
        private $duenioDAO;

        function __construct(){
            $this->guardianDAO = new GuardianDAO();
            $this->duenioDAO = new DuenioDAO();
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
                        $this->showView($guardian->getType());
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
                        $this->showView($duenio->getType());
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
            require_once(VIEWS_PATH."login.php");
        }


        public function showView($type){
            if($type == 'G'){
                require_once(VIEWS_PATH."guardian-page.php");
            }
            else{
                require_once(VIEWS_PATH."duenio-page.php");
            }
        }
    }
?>