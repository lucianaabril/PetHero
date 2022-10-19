<?php
    namespace Models;
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

        public function getPeso(){return $this->peso;}

        public function setPeso($peso){$this->peso = $peso;}

        public function getFormato(){return $this->formato;}

        public function setFormato($formato){$this->formato = $formato;}

        public function getExtension(){return $this->extension;}

        public function setExtension($extension){$this->extension = $extension;}

        public function getUrl(){return $this->url;}

        public function setUrl($url){$this->url = $url;}
    }
?>