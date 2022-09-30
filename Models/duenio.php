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
    }
?>