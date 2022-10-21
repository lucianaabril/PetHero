<?php
    namespace Models;
    use Models\User as User;

    class Duenio extends User{
        private $nombre;
        private $apellido;
        private $telefono;
        private $direccion;
        private $dni;
    
        public function __construct(){
        }

        public function getNombre(){return $this->nombre;}

        public function setNombre($nombre){$this->nombre = $nombre;}

        public function getApellido(){return $this->apellido;}

        public function setApellido($apellido){$this->apellido = $apellido;}

        public function getTelefono(){return $this->telefono;}

        public function setTelefono($telefono){$this->telefono = $telefono;}

        public function getDireccion(){return $this->direccion;}

        public function setDireccion($direccion){$this->direccion = $direccion;}

        public function getDni(){return $this->dni;}

        public function setDni($dni){$this->dni = $dni;}
    }
?>
    