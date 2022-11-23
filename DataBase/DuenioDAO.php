<?php
namespace DataBase;
use Models\Duenio as Duenio;
use DataBase\Connection as Connection;
use FFI\Exception as Exception;

    class DuenioDAO{
        private $connection;
        private $tableName = "duenios";

        function Add(Duenio $duenio){
            $query = "INSERT INTO " . $this->tableName . " (dni_duenio, email, password, type, nombre, apellido, telefono, direccion, cumpleanios) VALUES (:dni,:email,:password,:type,:nombre,:apellido,:telefono,:direccion,:cumpleanios);"; 
            try{
                $parametros["dni"] = $duenio->getDni();
                $parametros["email"] = $duenio->getEmail();
                $parametros["password"] = $duenio->getPassword();
                $parametros["type"] = $duenio->getType();
                $parametros["nombre"] = $duenio->getNombre();
                $parametros["apellido"] = $duenio->getApellido();
                $parametros["telefono"] = $duenio->getTelefono();
                $parametros["direccion"] = $duenio->getDireccion();
                $parametros["cumpleanios"] = $duenio->getCumpleanios();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parametros);
            }
            catch(Exception $ex) {
                throw $ex;}
        }

        function GetAll(){
            try{
                $duenios = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $lista = $this->connection->Execute($query);
                foreach($lista as $d){ //d es un array
                    $nuevoDuenio = $this->nuevoDuenio($d);
                    array_push($duenios, $nuevoDuenio);}
                return $duenios;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function nuevoDuenio($parametros){
            $duenio = new Duenio();
            $duenio->setEmail($parametros["email"]);
            $duenio->setDni($parametros["dni_duenio"]);
            $duenio->setPassword($parametros["password"]);
            $duenio->setType($parametros["type"]);
            $duenio->setNombre($parametros["nombre"]);
            $duenio->setApellido($parametros["apellido"]);
            $duenio->setTelefono($parametros["telefono"]);
            $duenio->setDireccion($parametros["direccion"]);
            $duenio->setCumpleanios($parametros["cumpleanios"]);
            return $duenio;
        }

        function getByEmail($email){
            try{
                $query = "SELECT * FROM " . $this->tableName . " WHERE (email = :email);";
                $parametro["email"] = $email;
                $this->connection = Connection::GetInstance();
                $resultado = $this->connection->Execute($query, $parametro);
                $duenio = null;

                if($resultado){
                    $parametros = $resultado[0]; //matriz de una sola fila 
                    $duenio = $this->nuevoDuenio($parametros);
                }
                return $duenio;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }
?>