<?php
    namespace Models;
    use Models\User as User;

    class Guardian extends User{
        private $nombre;
        private $apellido;
        private $dni;
        private $telefono;
        private $direccion;
        private $cumpleanios;
        private $disponibilidad;
        private $tarifa;
        private $preferencia;
        private $cbu;
        private $alias;
    
        public function __construct(){
            $this->disponibilidad = array();
        }

        public function getCBU(){return $this->cbu;}

        public function setCBU($cbu){$this->cbu = $cbu;}

        public function getAlias(){return $this->alias;}

        public function setAlias($alias){$this->alias = $alias;}

        public function getNombre(){return $this->nombre;}

        public function setNombre($nombre){$this->nombre = $nombre;}

        public function getApellido(){return $this->apellido;}

        public function setApellido($apellido){$this->apellido = $apellido;}
 
        public function getDni(){return $this->dni;}

        public function setDni($dni){$this->dni = $dni;}

        public function getTelefono(){return $this->telefono;}

        public function setTelefono($telefono){$this->telefono = $telefono;}

        public function getDireccion(){return $this->direccion;}

        public function setDireccion($direccion){$this->direccion = $direccion;}

        public function getDisponibilidad(){return $this->disponibilidad;}

        public function setDisponibilidad($fecha, $disp){
            if(array_key_first($this->disponibilidad) == ""){
                $this->disponibilidad = array();
            }
            $this->disponibilidad[$fecha] = $disp;
        }

        public function newDisponibilidad($disp){
            $this->disponibilidad = $disp;
        }

        public function getTarifa(){return $this->tarifa;}

        public function setTarifa($tarifa){$this->tarifa = $tarifa;}

        public function getCumpleanios(){return $this->cumpleanios;}

        public function setCumpleanios($cumpleanios){$this->cumpleanios = $cumpleanios;}
    
        public function getPreferencia(){return $this->preferencia;}

        public function setPreferencia($preferencia){$this->preferencia = $preferencia;}

    }
?>