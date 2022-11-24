<?php
    namespace DAO;
    use Models\Cupon as Cupon;

    class CuponDAO{
        private $list = array();
        private $filename;

        public function __construct()
        {
            $this->filename = dirname(__DIR__) . "/Data/cupones.json";
        }

        function Add(Cupon $cupon)
        {
            $this->LoadData();
            array_push($this->list, $cupon);
            $this->SaveData();
        }

        public function GetAll()
        {
            $this->loadData();
            return $this->list;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach ($this->list as $cupon) {
                $valuesArray = array();
                $valuesArray["monto"] = $cupon->getMonto();
                $valuesArray["fecha"] = $cupon->getFecha();
                $valuesArray["detalles"] = $cupon->getDetalles();

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
                    $cupon = new Cupon();
                    $cupon->setMonto($item["monto"]);
                    $cupon->setFecha($item["fecha"]);
                    $cupon->setDetalles($item["detalles"]);

                    array_push($this->list, $cupon);
                }
            }
        }
    }

?>