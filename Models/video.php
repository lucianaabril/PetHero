<?php
    namespace Sistema\Multimedia;
    class Video{
        public $peso;
        public $extension;
        public $duracion;
    
        public function __construct($peso, $extension, $duracion){
            $this->peso = $peso;
            $this->extension = $extension;
            $this->duracion = $duracion;
        }
    }
?>