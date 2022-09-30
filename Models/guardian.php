<?php
    namespace Usuarios;
    class Guardian{
        public $nombre;
        public $apellido;
        public $cuil;
        public $telefono;
        public $direccion;
        public $disponibilidad;
        public $tarifa;
    
        public function __construct($nombre, $apellido, $cuil, $telefono, $direccion, $disponibilidad, $tarifa){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->cuil = $cuil;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->disponibilidad = $disponibilidad;
            $this->tafira = $tarifa;
        }
    }
?>