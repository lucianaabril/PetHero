<?php
namespace Controllers;

use Models\Mascota as Mascota;
use DAO\MascotaDAO as mascotaDAO;
use Models\Duenio as Duenio;

class MascotasController{
    private $mascotaDAO;

    function __construct(){
        $this->mascotaDAO = new mascotaDAO;
    }

    public function Add($nombre = '',$edad = '',$raza = '',$tamanio = '',$observaciones = '',$tipo = ''){
        $pet = new Mascota();
        $pet->setNombre($nombre);
        $pet->setEdad($edad);
        $pet->setRaza($raza);
        $pet->setTamanio($tamanio);
        $pet->setObservaciones($observaciones);
        $pet->setTipo($tipo);
        $user = new Duenio();
        $user = $_SESSION["loggeduser"];
        $pet->setDni_duenio($user->getDni());

        $this->mascotaDAO->Add($pet);
        
        //podríamos hacer una excepción
        echo "Su mascota ha sido agregada con éxito";   
    }


    public function getMascotasByDuenio(){
        $array = array();
        $user = new Duenio();
        $user = $_SESSION["loggeduser"];
        $array = $this->mascotaDAO->getByDniDuenio($user->getDni());
        return $array;
    }

    public function viewAddMascota(){
        require_once(VIEWS_PATH ."add-mascota.php");
    }

    
}
?>