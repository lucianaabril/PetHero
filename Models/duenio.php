<?php
    namespace Usuarios;
    class Duenio{
        public $nombre;
        public $apellido;
        public $telefono;
        public $direccion;
        public $dni;

        public function __construct($nombre, $apellido, $telefono, $direccion, $dni){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->dni = $dni;
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
    