<?php

namespace DAO;

use Models\Mascota as Mascota;

class MascotaDAO
{
    private $list = array();
    private $filename;

    public function __construct()
    {
        $this->filename = dirname(__DIR__) . "Data/mascotas.json";
    }

    function Add(Mascota $pet)
    {
        $this->LoadData();
        array_push($this->list, $pet);
        $this->SaveData();
    }

    public function GetAll()
    {
        $this->loadData();
        return $this->list;
    }

    public function getByDniDuenio($dni)
    {
        $this->loadData();
        foreach ($this->list as $item) {
            if ($item->getDni_duenio() == $dni)
                return $item;
        }
        return null;
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->list as $pet) {
            $valuesArray = array();
            $valuesArray["nombre"] = $pet->getNombre();
            $valuesArray["edad"] = $pet->getEdad();
            $valuesArray["raza"] = $pet->getRaza();
            $valuesArray["tamanio"] = $pet->getTamanio();
            $valuesArray["observaciones"] = $pet->getCuil();
            $valuesArray["dni_duenio"] = $pet->getDisponibilidad();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $jsonContent);
    }

    private function LoadData()
    {
        $this->list = array();

        if (file_exists($this->filename)) {
            $jsonContent = file_get_contents($this->filename);
            $array = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($array as $item) {
                $pet = new Mascota();
                $pet->setNombre($item["nombre"]);
                $pet->setEdad($item["edad"]);
                $pet->setRaza($item["raza"]);
                $pet->setTamanio($item["tamanio"]);
                $pet->setObservaciones($item["observaciones"]);
                $pet->setDni_duenio($item["dni_duenio"]);

                array_push($this->list, $pet);
            }
        }
    }
}
