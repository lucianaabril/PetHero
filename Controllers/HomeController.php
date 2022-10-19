<?php
    namespace Controllers;
    use Controllers\UserController as UserController;

    class HomeController
    {
        public function Index()
        {
            $auth = new AuthController();
            if(isset($_SESSION["loggeduser"])){
                $auth->showView($_SESSION["type"]);
            }
            else
                $auth->login($_SESSION['email'],$_SESSION['password']);
        }
    }
?>