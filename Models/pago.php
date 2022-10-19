<?php
    namespace Sistema;
    class Pago{
        public $forma_pago;
        public $fecha;
        public $monto;
    
        public function __construct($forma_pago, $fecha, $monto){
            $this->forma_pago = $forma_pago;
            $this->fecha = $fecha;
            $this->monto = $monto;
        }

        public function getForma_pago(){return $this->forma_pago;}
 
        public function setForma_pago($forma_pago){$this->forma_pago = $forma_pago;}

        public function getFecha(){return $this->fecha;}

        public function setFecha($fecha){$this->fecha = $fecha;}

        public function getMonto(){return $this->monto;}

        public function setMonto($monto){$this->monto = $monto;}
    }
?>