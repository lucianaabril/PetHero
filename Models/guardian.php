<?php
    namespace Models;
    use Models\User as User;

    class Guardian extends User{
        private $nombre;
        private $apellido;
        private $cuil;
        private $telefono;
        private $direccion;
        private $disponibilidad;
        private $tarifa;
    
        public function __construct(){
        }

        public function getNombre(){return $this->nombre;}

        public function setNombre($nombre){$this->nombre = $nombre;}

        public function getApellido(){return $this->apellido;}

        public function setApellido($apellido){$this->apellido = $apellido;}
 
        public function getCuil(){return $this->cuil;}

        public function setCuil($cuil){$this->cuil = $cuil;}

        public function getTelefono(){return $this->telefono;}

        public function setTelefono($telefono){$this->telefono = $telefono;}

        public function getDireccion(){return $this->direccion;}

        public function setDireccion($direccion){$this->direccion = $direccion;}

        public function getDisponibilidad(){return $this->disponibilidad;}

        public function setDisponibilidad($disponibilidad){$this->disponibilidad = $disponibilidad;}

        public function getTarifa(){return $this->tarifa;}

        public function setTarifa($tarifa){$this->tarifa = $tarifa;}
    }
?>