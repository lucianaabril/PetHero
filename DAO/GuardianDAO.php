<?php
    namespace DAO;
    use Models\Guardian as Guardian;
    use Models\User as User;

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
            $guardian = new Guardian();
            $guardian->setNombre($item["nombre"]);
            $guardian->setApellido($item["apellido"]);
            $guardian->setDni($item["dni"]);
            $guardian->setTelefono($item["telefono"]);
            $guardian->setDireccion($item["direccion"]);
            $guardian->setCumpleanios($item["cumpleanios"]);
            $guardian->setDisponibilidad(null);
            $guardian->setTarifa(null);
            $guardian->setEmail($item["email"]);
            $guardian->setPassword($item["password"]);
            $guardian->setPreferencia($item["preferencia"]);
            
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
            $valuesArray["dni"] = $guardian->getDni();
            $valuesArray["cumpleanios"] = $guardian->getCumpleanios();
            $valuesArray["disponibilidad"] = $guardian->getDisponibilidad();
            $valuesArray["tarifa"] = $guardian->getTarifa();
            $valuesArray["email"] = $guardian->getEmail();
            $valuesArray["password"] = $guardian->getPassword();
            $valuesArray["preferencia"] = $guardian->getPreferencia();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $jsonContent);
    }

    public function Update(Guardian $guardian){
      $this->LoadData();
      $newList = array();
      foreach($this->list as $value){
          if($value->getEmail() == $guardian->getEmail()){
            array_push($newList, $guardian);
          }
          else {
            array_push($newList, $value);
          }
      }
      $this->list = $newList;
      $this->SaveData();
    }
  }
?>