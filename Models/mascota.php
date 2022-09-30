<?php
    namespace Usuarios;
    class Mascota{
        public $nombre;
        public $edad;
        public $raza;
        public $tamanio;
        public $observaciones;
        public $dni_duenio;

        public function __construct($nombre, $apellido, $edad, $raza, $tamanio, $observaciones, $dni_duenio){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->edad = $edad;
            $this->raza = $raza;
            $this->tamanio = $tamanio;
            $this->observaciones = $observaciones;
            $this->dni_duenio = $dni_duenio;
        }
    }
?>