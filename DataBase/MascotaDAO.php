<?php
    namespace DataBase;
    use Models\Mascota as Mascota;
    use DataBase\Connection as Connection;


    class MascotaDAO{
        private $connection;
        private $tableName = "mascotas";

        function Add(Mascota $mascota){
            try{
                $query = "INSERT INTO " . $this->tableName . " (dni_duenio, nombre, tipo, edad, raza, tamanio, observaciones, foto, vacunacion, video) VALUES (:dni_duenio,:nombre,:tipo,:edad,:raza,:tamanio,:observaciones,:foto,:vacunacion,:video);";
                $parametros["nombre"] = $masota->getNombre();
                $parametros["tipo"] = $masota->getTipo();
                $parametros["edad"] = $masota->getEdad();
                $parametros["raza"] = $masota->getRaza();
                $parametros["tamanio"] = $masota->getTamanio();
                $parametros["observaciones"] = $masota->getObservaciones();
                $parametros["dni_duenio"] = $masota->getDni_duenio();
                $parametros["foto"] = $masota->getFoto();
                $parametros["vacunacion"] = $masota->getVacunacion();
                $parametros["video"] = $masota->getVideo();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parametros);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function GetAll(){
            try{
                $mascotas = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultado = $this->connection->Execute($query);
                foreach($resultado as $m){
                    $nuevaMascota = $this->nuevaMascota($m);
                    array_push($mascotas, $nuevaMascota);
                }
                return $mascotas;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function nuevaMascota($parametros){
            $mascota = new Mascota();
            $mascota->setNombre($parametros["nombre"]);
            $mascota->setTipo($parametros["tipo"]);
            $mascota->setEdad($parametros["edad"]);
            $mascota->setRaza($parametros["raza"]);
            $mascota->setTamanio($parametros["tamanio"]);
            $mascota->setObservaciones($parametros["observaciones"]);
            $mascota->setDni_duenio($parametros["dni_duenio"]);
            $mascota->setFoto($parametros["foto"]);
            $mascota->setVacunacion($parametros["vacunacion"]);
            $mascota->setVideo($parametros["video"]);
            return $mascota;
        }

        function getByDniDuenio($dni_duenio){
            try{
                $query = "SELECT * FROM " . $this->tableName . " WHERE (dni_duenio = :dni_duenio);";
                $parametro["dni_duenio"] = $dni_duenio;
                $this->connection = Connection::GetInstance();
                $resultado = $this->connection->Execute($query);
                $mascota = null;

                if($resultado){
                    $parametros = $resultado[0];
                    $mascota = nuevaMascota($parametros);
                }
                return $mascota;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        /*function last(){

        }

        function update(Mascota $mascota){

        }*/

    }




?>