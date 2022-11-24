<?php
    namespace Controllers;
    use Models\Cupon as Cupon;
    use DAO\CuponDAO as cuponDAO;

    class CuponController{
        private $cuponDAO;

        function __contruct(){
            $this->cuponDAO = new cuponDAO;
        }

        public function Add($monto = '', $fecha = '', $detalles = ''){
            $cupon = new Cupon();
            $cupon->setMonto($monto);
            $cupon->setFecha($fecha);
            $cupon->setDetalles($detalles);
    
            $this->cuponDAO->Add($cupon);
            //require_once(VIEWS_PATH . '');
        }        
    }


?>