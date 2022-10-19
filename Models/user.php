<?php
    namespace Models;

    class User{
        private $email;
        private $type;
        private $password;

        public function getEmail(){return $this->email;}

        public function setEmail($email){$this->email = $email;}

        public function getType(){return $this->type;}

        public function setType($type){$this->type = $type;}

        public function getPassword(){return $this->password;}

        public function setPassword($password){$this->password = $password;}
    }
?>