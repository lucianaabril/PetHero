<?php
namespace Controllers;

use Models\Mascota as Mascota;
use DAO\MascotaDAO as mascotaDAO;

class MascotasController{
    private $mascotaDAO;

    function __construct(){
        $this->mascotaDAO = new mascotaDAO;
    }

    public function Add(){
        var_dump($_SESSION);
        var_dump($_POST);
        $pet = new Mascota();
        /* setear valores en pet*/

        $this->mascotaDAO->Add($pet);

        $this->mascotaDAO->GetAll();
    }

    public function viewAddMascota(){
        require_once(VIEWS_PATH ."add-mascota.php");
    }
}
?>