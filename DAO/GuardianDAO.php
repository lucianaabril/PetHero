<?php
    namespace DAO;
    use Models\Guardian as Guardian;

    class GuardianDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/guardianes.json";
      }

      function Add(Guardian $guardian){
        $this->LoadData();
        array_push($this->list, $guardian);
        $this->SaveData();
    }

      public function GetAll()
      {
        $this->loadData();
        return $this->list;
      }

      public function getByCuil($cuil) 
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getCuil() == $cuil)
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
            $guardian = new Guardian(
                $item["nombre"],
                $item["apellido"],
                $item["cuil"],
                $item["telefono"],
                $item["direccion"],
                $item["disponibilidad"],
                $item["tarifa"],
                $item["email"],
                $item["password"]
            );
            
            array_push($this->list, $guardian);
          }
        }
      }



      private function SaveData(){
        $arrayToEncode = array();

        foreach($this->list as $guardian){
            $valuesArray = array();
            $valuesArray["nombre"] = $guardian->getNombre();
            $valuesArray["apellido"] = $guardian->getApellido();
            $valuesArray["telefono"] = $guardian->getTelefono();
            $valuesArray["direccion"] = $guardian->getDireccion();
            $valuesArray["cuil"] = $guardian->getCuil();
            $valuesArray["disponibilidad"] = $guardian->getDisponibilidad();
            $valuesArray["tarifa"] = $guardian->getTarifa();
            $valuesArray["email"] = $guardian->getEmail();
            $valuesArray["password"] = $guardian->getPassword();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $jsonContent);
    }

    }
?>