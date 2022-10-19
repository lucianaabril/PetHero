<?php
    namespace Controllers;
    use Model\user as User;
    use DAO\userDAO as UserDAO;
    use Controllers\UserController as UserController;

    class AuthController{
        private $userDAO;

        function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function login($email, $password){
            $user = new User();
            $user = $this->userDAO->getEmail($email);
            if($user){
                if($user->getPassword() == $password){
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['type'] = $user->getType();
                    $controller = new UserController();
                    $controller->list();
                }
                else{
                    require_once(VIEWS_PATH.);//agregar la view de login//)
                }
            }
            else{ 
                require_once(VIEWS_PATH.);//agregar la vista de login
            }
        }

        public function logout(){
            session_start();
            session_destroy();
            require_once(VIEWS_PATH.);//agregar vista de login
        }

        public function showView($type){
            if($_SESSION['type'] = 'D'){
                require_once
            }
        }
    }
?>