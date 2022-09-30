<?php
    namespace Sistema;
    class Resenia{
        public $puntaje;
        public $observaciones;
        public $fecha;
    
        public function __construct($puntaje, $observaciones, $fecha){
            $this->puntaje = $puntaje;
            $this->observaciones = $observaciones;
            $this->fecha = $fecha;
        }
    }    
?>