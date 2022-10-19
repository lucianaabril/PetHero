<?php
    namespace DAO;
    use Usuarios\Guardian as Guardian;

    class DuenioDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/guardianas.json";
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
                $item["disponibilidad"],                $item["direccion"],
                $item["tarifa"],

            );
            
            array_push($this->list, $guardian);
          }
        }
      }
    }
?>