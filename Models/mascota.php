<?php
    namespace Models;
    class Mascota{
        public $nombre;
        public $edad;
        public $raza;
        public $tamanio;
        public $observaciones;
        public $dni_duenio;

        public function __construct(){
            
        }

        public function getNombre(){return $this->nombre;}

        public function setNombre($nombre){$this->nombre = $nombre;}

        public function getEdad(){return $this->edad;}

        public function setEdad($edad){$this->edad = $edad;}

        public function getRaza(){return $this->raza;}

        public function setRaza($raza){$this->raza = $raza;}

        public function getTamanio(){return $this->tamanio;}

        public function setTamanio($tamanio){$this->tamanio = $tamanio;}

        public function getObservaciones(){return $this->observaciones;}

        public function setObservaciones($observaciones){$this->observaciones = $observaciones;}

        public function getDni_duenio(){return $this->dni_duenio;}

        public function setDni_duenio($dni_duenio){$this->dni_duenio = $dni_duenio;}
    }
?>