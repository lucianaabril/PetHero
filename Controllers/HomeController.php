<?php
    namespace Controllers;
    use Controllers\UserController as UserController;

    class HomeController
    {
        public function Index()
        {
            if(isset($_SESSION['email'])){
                $controller = new UserController();
                $controller->List();
            }
            else
                require_once(VIEWS_PATH.); //agregar vista login
        }
    }
?>