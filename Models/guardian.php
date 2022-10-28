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
    
        public function __construct(){
            $this->disponibilidad = array();
        }

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

        public function setDisponibilidad($inicio, $final)
        {
            $this->disponibilidad[0] = $inicio;
            $this->disponibilidad[1] = $final;
        }

        public function getTarifa(){return $this->tarifa;}

        public function setTarifa($tarifa){$this->tarifa = $tarifa;}

        public function getCumpleanios(){return $this->cumpleanios;}

        public function setCumpleanios($cumpleanios){$this->cumpleanios = $cumpleanios;}
    
        public function getPreferencia(){return $this->preferencia;}

        public function setPreferencia($preferencia){$this->preferencia = $preferencia;}

        public function showGuardian(){
            echo "Nombre: ".$this->getNombre();?><html> <br></html> <?php
            echo "Apellido: ".$this->getApellido();?><html> <br></html> <?php
            echo "Telefono: ".$this->getTelefono();?><html> <br></html> <?php
            echo "Disponibilidad: ". print_r($this->getDisponibilidad());?><html> <br></html> <?php
            echo "Tarifa: ".$this->getTarifa();?><html> <br></html> <?php
            echo "Preferencia: ".$this->getPreferencia();?><html> <br></html> <?php
            ?><html> <br></html> <?php
        }
    
    }
?>