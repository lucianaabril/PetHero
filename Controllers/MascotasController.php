<?php
namespace Controllers;

use Models\Mascota as Mascota;
use DataBase\MascotaDAO as mascotaDAO;
use Models\Duenio as Duenio;
use Controllers\FileController as Controller;
use Exception;

class MascotasController{
    private $mascotaDAO;

    function __construct(){
        $this->mascotaDAO = new mascotaDAO;
    }

    public function Add($nombre = '', $tipo = '', $edad = '', $raza = '', $tamanio = '', $observaciones = ''){
        try{
            $pet = new Mascota();
            $pet->setNombre($nombre);
            $pet->setTipo($tipo);
            $pet->setEdad($edad);
            $pet->setRaza($raza);
            $pet->setTamanio($tamanio);
            $pet->setObservaciones($observaciones);
            $user = new Duenio();
            $user = $_SESSION["loggeduser"];
            $pet->setDni_duenio($user->getDni());
    
            $this->mascotaDAO->Add($pet);
            require_once(VIEWS_PATH . 'add-mascota-files.php');
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getMascotasByDuenio(){
        try{
            $array = array();
            $user = new Duenio();
            $user = $_SESSION["loggeduser"];
            $array = $this->mascotaDAO->getByDniDuenio($user->getDni());
            return $array;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function viewAddMascota(){
        require_once(VIEWS_PATH ."add-mascota.php");
    }

    
}
?>