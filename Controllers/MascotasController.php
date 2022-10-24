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

    public function Add($nombre = '',$edad = '',$raza = '',$tamanio = '',$observaciones = ''){
        $pet = new Mascota();
        $pet->setNombre($nombre);
        $pet->setEdad($edad);
        $pet->setRaza($raza);
        $pet->setTamanio($tamanio);
        $pet->setObservaciones($observaciones);
        $user = new Duenio();
        $user = $_SESSION["loggeduser"];
        $pet->setDni_duenio($user->getDni());
        

        $this->mascotaDAO->Add($pet);
        
        echo "Su mascota ha sido agregada con éxito";
        
    }

    public function showMascotasByDuenio(){
        $array = array();
        $i=1;
        $user = new Duenio();
        $user = $_SESSION["loggeduser"];
        $array = $this->mascotaDAO->getByDniDuenio($user->getDni());
        foreach($array as $pet){
            echo "Mascota " . $i ;?><html> <br></html> <?php
            $i++;
            echo "Nombre: ".$pet->getNombre();?><html> <br></html> <?php
            echo "Edad: ".$pet->getEdad();?><html> <br></html> <?php
            echo "Raza: ".$pet->getRaza();?><html> <br></html> <?php
            echo "Tamaño: ".$pet->getTamanio();?><html> <br></html> <?php
            echo "Obervaciones: ".$pet->getObservaciones();?><html> <br></html> <?php
            ?><html> <br></html> <?php
        }
    }

    public function viewAddMascota(){
        require_once(VIEWS_PATH ."add-mascota.php");
    }
}
?>