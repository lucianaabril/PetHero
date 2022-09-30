<?php
    namespace Sistema\Multimedia;
    class Imagen{
        public $peso;
        public $formato;
        public $extension;
        public $url;
    
        public function __construct($peso, $formato, $extension, $url){
            $this->peso = $peso;
            $this->formato = $formato;
            $this->extension = $extension;
            $this->url = $url;
        }
    }
?>