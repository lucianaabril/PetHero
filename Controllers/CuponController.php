<?php
    namespace Controllers;
    use Models\Cupon as Cupon;
    use DataBase\CuponDAO as cuponDAO; 
    use Exception as Exception;

    class CuponController{
        private $cuponDAO;

        function __contruct(){
            $this->cuponDAO = new cuponDAO;
        }

        public function Add($monto = '', $fecha = '', $detalles = ''){
            try{
                $cupon = new Cupon();
                $cupon->setMonto($monto);
                $cupon->setFecha($fecha);
                $cupon->setDetalles($detalles);
        
                $this->cuponDAO->Add($cupon);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }        
    }


?>