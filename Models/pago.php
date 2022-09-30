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
    }
?>