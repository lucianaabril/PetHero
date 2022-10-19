<?php
    namespace DAO;
    use Usuarios\Duenio as Duenio;

    class DuenioDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/duenios.json";
      }

      public function GetAll()
      {
        $this->loadData();
        return $this->list;
      }

      public function getByEmail($dni) 
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getDni() == $dni)
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
                $item["dni"]
            );
            
            array_push($this->list, $duenio);
          }
        }
      }
    }
?>