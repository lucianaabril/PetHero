<?php

namespace DAO;

use Models\Mascota as Mascota;

class MascotaDAO
{
    private $list = array();
    private $filename;

    public function __construct()
    {
        $this->filename = dirname(__DIR__) . "/Data/mascotas.json";
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
        $array = array();
        foreach ($this->list as $item) {
            if ($item->getDni_duenio() == $dni)
                array_push($array,$item);
        }
        return $array;
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->list as $pet) {
            $valuesArray = array();
            $valuesArray["nombre"] = $pet->getNombre();
            $valuesArray["tipo"] = $pet->getTipo();
            $valuesArray["edad"] = $pet->getEdad();
            $valuesArray["raza"] = $pet->getRaza();
            $valuesArray["tamanio"] = $pet->getTamanio();
            $valuesArray["observaciones"] = $pet->getObservaciones();
            $valuesArray["dni_duenio"] = $pet->getDni_duenio();
            $valuesArray["foto"] = $pet->getFoto();
            $valuesArray["vacunacion"] = $pet->getVacunacion();
            $valuesArray["video"] = $pet->getVideo();

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
                $pet->setTipo($item["tipo"]);
                $pet->setEdad($item["edad"]);
                $pet->setRaza($item["raza"]);
                $pet->setTamanio($item["tamanio"]);
                $pet->setObservaciones($item["observaciones"]);
                $pet->setDni_duenio($item["dni_duenio"]);
                $pet->setFoto($item["foto"]);
                $pet->setVacunacion($item["vacunacion"]);
                $pet->setVideo($item["video"]);

                array_push($this->list, $pet);
            }
        }
    }

    public function last(){
        $this->LoadData();
        $mascota = array_pop($this->list);
        $this->SaveData();
        return $mascota;
    }

    public function update(Mascota $mascota){
        $this->LoadData();
        $newList = array();

        foreach($this->list as $i){
            if($i->getDni_Duenio() == $mascota->getDni_duenio()){
                if($i->getNombre() == $mascota->getNombre()){
                    array_push($newList, $mascota);
                }
            }
            else {
              array_push($newList, $i);
            }
        }
        $this->list = $newList;
        $this->SaveData();
    }
}
