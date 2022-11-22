<?php
    namespace Models;

    class Cupon{
        private $monto;
        private $fecha;
        private $detalles;

        public function __construct(){}

        public function getMonto(){return $this->monto;}

        public function setMonto($monto){$this->monto = $monto;}

        public function getFecha(){return $this->fecha;}

        public function setFecha($fecha){$this->fecha = $fecha;}

        public function getDetalles(){return $this->detalles;}

        public function setDetalles($detalles){$this->detalles = $detalles;}
    }
?>