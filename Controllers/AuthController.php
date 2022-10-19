<?php
    namespace Controllers;
    use Models\Duenio as Duenio;
    use Models\Guardian as Guardian;
    use DAO\GuardianDAO as GuardianDAO;
    use DAO\DuenioDAO as DuenioDAO;
    use Controllers\UserController as UserController;

    class AuthController{
        private $userDAO;

        function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function login($email, $password){
            /*$user = new User();
            $user = $this->userDAO->getEmail($email);
            if($user){
                if($user->getPassword() == $password){
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['type'] = $user->getType();
                    $controller = new UserController();
                    $controller->list();
                }
                else{
                    require_once(VIEWS_PATH."login.php");//agregar la view de login//)
                }
            }
            else{ 
                require_once(VIEWS_PATH."login.php");//agregar la vista de login
            }
            */

            if($email == "" or $password == ""){
                require_once(VIEWS_PATH."login.php");
            }
            else{
                $duenioDAO = new DuenioDAO();
                $duenio = new Duenio();
                $duenio = $duenioDAO->getByEmail($email);

                $guardian = new Guardian();
            }
            */

            if($email == "" or $password == ""){
                require_once(VIEWS_PATH."login.php");
            }
            else{
                $duenioDAO = new DuenioDAO();
                $duenio = new Duenio();
                $duenio = $duenioDAO->getByEmail($email);

                $guardian = new Guardian();
            }
        }

        public function logout(){
            session_start();
            session_destroy();
            require_once(VIEWS_PATH."login.php");//agregar vista de login
        }

        public function showView($type){
            if($type = 'G'){
                require_once(VIEWS_PATH."guardian-page.php");
            }
            else{
                require_once(VIEWS_PATH."duenio-page.php");
            }
        }
    }
?>