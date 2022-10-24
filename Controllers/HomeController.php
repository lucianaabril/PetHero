<?php
    namespace Controllers;
    use Controllers\UserController as UserController;

    class HomeController
    {
        public function Index()
        {
            $user = new UserController();
            if(isset($_SESSION["loggeduser"])){
                $user->showView($_SESSION["type"]);
            }
            else
                $this->showHomeView();
        }

        public function showHomeView(){
            require_once(VIEWS_PATH . "home.php");
        }
    }
?>