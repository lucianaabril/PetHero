<?php

namespace Usuarios;

class Guardian{
    public $nombre;
    public $apellido;
    public $cuil;
    public $telefono;
    public $direccion;
    public $disponibilidad;
    public $tarifa;

    public function __construct($nombre, $apellido, $cuil, $telefono, $direccion, $disponibilidad, $tarifa){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cuil = $cuil;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->disponibilidad = $disponibilidad;
        $this->tafira = $tarifa;
    }
}

class Duenio{
    public $nombre;
    public $apellido;
    public $telefono;
    public $direccion;
    public $dni;

    public function __construct($nombre, $apellido, $telefono, $direccion, $dni){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->dni = $dni;
    }
}

class Mascota{
    public $nombre;
    public $edad;
    public $raza;
    public $tamanio;
    public $observaciones;
    public $dni_duenio;

    public function __construct($nombre, $apellido, $edad, $raza, $tamanio, $observaciones, $dni_duenio){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->raza = $raza;
        $this->tamanio = $tamanio;
        $this->observaciones = $observaciones;
        $this->dni_duenio = $dni_duenio;
    }
}

?>