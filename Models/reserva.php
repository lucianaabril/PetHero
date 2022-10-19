<?php
    namespace Models;
    class Reserva{
        public $fecha;
        public $hora;
        public $id_reserva;
        public $estado;
    
        public function __construct($fecha, $hora, $id_reserva, $estado){
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->id_reserva = $id_reserva;
            $this->estado = $estado;
        }

        public function getFecha(){return $this->fecha;}

        public function setFecha($fecha){$this->fecha = $fecha;}

        public function getHora(){return $this->hora;}
 
        public function setHora($hora){$this->hora = $hora;}

        public function getId_reserva(){return $this->id_reserva;}

        public function setId_reserva($id_reserva){$this->id_reserva = $id_reserva;}

        public function getEstado(){return $this->estado;}

        public function setEstado($estado){$this->estado = $estado;}
    }
?>