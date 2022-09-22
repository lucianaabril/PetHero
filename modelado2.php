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

class Resenia{
    public $puntaje;
    public $observaciones;
    public $fecha;

    public function __construct($puntaje, $observaciones, $fecha){
        $this->puntaje = $puntaje;
        $this->observaciones = $observaciones;
        $this->fecha = $fecha;
    }
}

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

namespace Sistema\Multimedia;

class Video{
    public $peso;
    public $extension;
    public $duracion;

    public function __construct($peso, $extension, $duracion){
        $this->peso = $peso;
        $this->extension = $extension;
        $this->duracion = $duracion;
    }
}

class Imagen{
    public $peso;
    public $formato;
    public $extension;
    public $url;

    public function __construct($peso, $formato, $extension, $url){
        $this->peso = $peso;
        $this->formato = $formato;
        $this->extension = $extension;
        $this->url = $url;
    }
}


?>