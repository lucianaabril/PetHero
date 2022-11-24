<?php
namespace DataBase;
use Models\Cupon as Cupon;
use DataBase\Connection as Connection;
use FFI\Exception as Exception;

class CuponDAO{
    private $connection;
    private $tableName = "cupones";

    function Add(Cupon $cupon){
        try{
            $query = "INSERT INTO " . $this->tableName . " (id_reserva,fecha,detalles,monto) VALUES (:id_reserva,:fecha,:detalles,:monto);";
            $parametros["id_reserva"] = $cupon->getId_reserva();
            $parametros["fecha"] = $cupon->getFecha();
            $parametros["detalles"] = $cupon->getDetalles();
            $parametros["monto"] = $cupon->getMonto();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parametros);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    function nuevoCupon($parametros){
        $cupon = new Cupon();
        $cupon->setId_reserva($parametros["id_reserva"]);
        $cupon->setFecha($parametros["fecha"]);
        $cupon->setDetalles($parametros["detalles"]);
        $cupon->setMonto($parametros["monto"]);
        return $cupon;
    }


    function GetAll(){
        try{
            $cupones = array();
            $query = "SELECT * FROM " . $this->tableName;
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);
            foreach($resultado as $c){
                $nuevoCupon = $this->nuevoCupon($c);
                array_push($cupones, $nuevoCupon);
            }
            return $cupones;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    function getByIdReserva($id){
        try{
            $query = "SELECT * FROM " .$this->tableName . "WHERE (id_reserva = :id_reserva);";
            $parametro["id_reserva"] = $id;
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query,$parametro);
            $mascota = null;

            if($resultado){
                $parametros = $resultado;
                $cupon = $this->nuevoCupon($parametros);
            }
            return $cupon;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }    
}

?>