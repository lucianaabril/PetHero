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
            $duenio = new Duenio(
                $item["nombre"],
                $item["apellido"],
                $item["telefono"],
                $item["direccion"],
                $item["dni"],
                $item["email"],
                $item["password"]
            );
            
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
            $valuesArray["telefono"] = $duenio->getTelefono();
            $valuesArray["direccion"] = $duenio->getDireccion();
            $valuesArray["dni"] = $duenio->getDni();
            $valuesArray["email"] = $duenio->getEmail();
            $valuesArray["password"] = $duenio->getPassword();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $jsonContent);
    }
    }
?>