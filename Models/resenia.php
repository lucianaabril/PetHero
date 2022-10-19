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

        public function getPuntaje(){return $this->puntaje;}

        public function setPuntaje($puntaje){$this->puntaje = $puntaje;}

        public function getObservaciones(){return $this->observaciones;}

        public function setObservaciones($observaciones){$this->observaciones = $observaciones;}

        public function getFecha(){return $this->fecha;}

        public function setFecha($fecha){$this->fecha = $fecha;}
    }    
?>