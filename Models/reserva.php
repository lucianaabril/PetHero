<?php
    namespace Sistema;
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
    }
?>