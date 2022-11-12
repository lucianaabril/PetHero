<?php
    namespace Models;
    use Models\Pago as Pago;

    class Reserva{
        public $fecha;
        public $hora;
        public $encuentro;
        public $id_reserva;
        public $estado; //programada, rechazada, cancelada, pendiente, servicio realizado
        public $dni_guardian;
        public $dni_duenio;
        public $nombre_mascota;
        public Pago $pago;
    
        public function __construct(){
            $this->pago = new Pago();
        }

        public function getFecha(){return $this->fecha;}

        public function setFecha($fecha){$this->fecha = $fecha;}

        public function getHora(){return $this->hora;}
 
        public function setHora($hora){$this->hora = $hora;}

        public function getId_reserva(){return $this->id_reserva;}

        public function setId_reserva($id_reserva){$this->id_reserva = $id_reserva;}

        public function getEstado(){return $this->estado;}

        public function setEstado($estado){$this->estado = $estado;}

        public function getDniGuardian(){return $this->dni_guardian;}

        public function setDniGuardian($dni_guardian){$this->dni_guardian = $dni_guardian;}

        public function getDniDuenio(){return $this->dni_duenio;}

        public function setDniDuenio($dni_duenio){$this->dni_duenio = $dni_duenio;}

        public function getDniEncuentro(){return $this->encuentro;}

        public function setDniEncuentro($encuentro){$this->encuentro = $encuentro;}

        public function getPago(){return $this->pago;}

        public function setPago(Pago $pago){$this->pago = $pago;}
    }
?>