<?php
    namespace Models;
    class Video{
        public $peso;
        public $extension;
        public $duracion;
    
        public function __construct($peso, $extension, $duracion){
            $this->peso = $peso;
            $this->extension = $extension;
            $this->duracion = $duracion;
        }

        public function getPeso(){return $this->peso;}

        public function setPeso($peso){$this->peso = $peso;}

        public function getExtension(){return $this->extension;}

        public function setExtension($extension){$this->extension = $extension;}

        public function getDuracion(){return $this->duracion;}

        public function setDuracion($duracion){$this->duracion = $duracion;}
    }
?>