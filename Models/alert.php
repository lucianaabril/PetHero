<?php

    namespace Models;

    class alert{
        private $message;
        private $type;

        function __construct(){
        }

        public function setMessage($message) {$this->message = $message;}

        public function getMessage(){return $this->message;}

        public function setType($type){$this->type = $type;}

        public function getType(){return $this->type;}

    }
?>