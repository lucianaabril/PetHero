<?php
    namespace DAO;
    use Models\Duenio as Duenio;

    class DuenioDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/duenios.json";
      }

      function Add(Duenio $duenio){
        $this->LoadData();
        array_push($this->list, $duenio);
        $this->SaveData();
      }

      public function GetAll()
      {
        $this->loadData();
        return $this->list;
      }

      public function getByEmail($email) 
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getEmail() == $email)
            return $item;
        }
        return null;
      }

      private function LoadData() 
      {
        $this->list = array();

        if(file_exists($this->filename)) 
        {
          $jsonContent = file_get_contents($this->filename);
          $array = ($jsonContent) ? json_decode($jsonContent, true) : array();
          
          foreach($array as $item) 
          {
            $duenio = new Duenio();
            $duenio->setNombre($item["nombre"]);
            $duenio->setApellido($item["apellido"]);
            $duenio->setDni($item["dni"]);
            $duenio->setTelefono($item["telefono"]);
            $duenio->setDireccion($item["direccion"]);
            $duenio->setCumpleanios($item["cumpleanios"]);
            $duenio->setEmail($item["email"]);
            $duenio->setPassword($item["password"]);
            $duenio->setType($item["type"]);
            
            array_push($this->list, $duenio);
          }
        }
      }

      private function SaveData(){
        $arrayToEncode = array();

        foreach($this->list as $duenio){
            $valuesArray = array();
            $valuesArray["nombre"] = $duenio->getNombre();
            $valuesArray["apellido"] = $duenio->getApellido();
            $valuesArray["dni"] = $duenio->getDni();
            $valuesArray["telefono"] = $duenio->getTelefono();
            $valuesArray["direccion"] = $duenio->getDireccion();
            $valuesArray["cumpleanios"] = $duenio->getCumpleanios();
            $valuesArray["email"] = $duenio->getEmail();
            $valuesArray["password"] = $duenio->getPassword();
            $valuesArray["type"] = $duenio->getType();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $jsonContent);
    }
    }
?>