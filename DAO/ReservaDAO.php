<?php
namespace DAO;
use Models\Pago as Pago;
use Models\Reserva as Reserva;

class ReservaDAO{
    private $list = array();
    private $filename;

    public function __construct(){
        $this->filename = dirname(__DIR__)."/Data/reservas.json";
    }

    function Add(Reserva $reserva){
        $this->LoadData();
        array_push($this->list,$reserva);
        $this->SaveData();
    }

    public function getLastId(){
        $this->LoadData();
        $last = array_pop($this->list);
        if($last){
            return $last->getId_reserva();
        } else {
            return null;
        }
    }

    public function GetAll(){
        $this->reservasConcretadas();
        $this->loadData();
        return $this->list;
    }

    public function updateEstado($id, $estado){
        $this->LoadData();
        foreach($this->list as $item){
            if($item->getId_reserva() == $id){
                $item->setEstado($estado);
            }
        }
        $this->SaveData();
    }

    public function getByDniUser($dni)
    {
        $user = $_SESSION["loggeduser"];
        $this->loadData();
        $array = array();
        foreach ($this->list as $item) {
            /*if($user->getType() == 'd'){
                if ($item->getDni_duenio() == $dni){
                    array_push($array,$item);
                }
            }*/
            //if ($user->getType() == 'g'){
                if ($item->getDniGuardian() == $dni){
                    array_push($array,$item);
                 }
            // }
        }
    
        return $array;
    }

    private function LoadData(){
        $this->list = array();

        if(file_exists($this->filename)){
            $jsonContent = file_get_contents($this->filename);
            $array = ($jsonContent) ? json_decode($jsonContent , true) : array();

            foreach($array as $item){
                $reserva = new Reserva();
                $reserva->setFecha($item["fecha"]);
                $reserva->setHora($item["hora"]);
                $reserva->setEncuentro($item["encuentro"]);
                $reserva->setId_reserva($item["id reserva"]);
                $reserva->setEstado($item["estado"]);
                $reserva->setDniGuardian($item["dni guardian"]);
                $reserva->setDniDuenio($item["dni duenio"]);
                $reserva->setNombre_mascota($item["nombre mascota"]);
                /*$pago = new Pago();
                $pago->setFecha($item["pago"]["fecha"]);
                $pago->setForma_pago($item["pago"]["forma de pago"]);
                $pago->setMonto($item["pago"]["monto"]);
                $reserva->setPago($pago);
                */

                array_push($this->list,$reserva);

            }
        }
    }

    private function reservasConcretadas(){
        $this->LoadData();
        foreach($this->list as $res){
            if($res->getEstado() == "programada"){
                if(date('Y-m-d') > $res->getFecha()){
                    $res->setEstado("servicio realizado");
                }
            }
        }
        $this->SaveData();
    }

    private function SaveData(){
        $arrayToEncode = array();
        foreach($this->list as $reserva){
            $values = array();
            $values["fecha"] = $reserva->getFecha();
            $values["hora"] = $reserva->getHora();
            $values["encuentro"] = $reserva->getEncuentro();
            $values["id reserva"] = $reserva->getId_reserva();
            $values["estado"] = $reserva->getEstado();
            $values["dni guardian"] = $reserva->getDniGuardian();
            $values["dni duenio"] = $reserva->getDniDuenio();
            $values["nombre mascota"] = $reserva->getNombre_mascota();
            /*$pago = new Pago();
            $pago = $reserva->getPago();
            $values["pago"]["fecha"] = $pago->getFecha();
            $values["pago"]["forma de pago"] = $pago->getForma_pago();
            $values["pago"]["monto"] = $pago->getMonto();
            */
            array_push($arrayToEncode,$values);
        }
        $jsonContent = json_encode($arrayToEncode,JSON_PRETTY_PRINT);
        file_put_contents($this->filename,$jsonContent);
    }

}
?>