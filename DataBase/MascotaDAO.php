<?php
    namespace DataBase;
    use Models\Mascota as Mascota;
    use DataBase\Connection as Connection;
    use FFI\Exception as Exception;


    class MascotaDAO{
        private $connection;
        private $tableName = "mascotas";

        function Add(Mascota $mascota){
            try{
                $query = "INSERT INTO " . $this->tableName . " (dni_duenio, nombre, tipo, edad, raza, tamanio, observaciones, foto, vacunacion, video) VALUES (:dni_duenio,:nombre,:tipo,:edad,:raza,:tamanio,:observaciones,:foto,:vacunacion,:video);";
                $parametros["nombre"] = $mascota->getNombre();
                $parametros["tipo"] = $mascota->getTipo();
                $parametros["edad"] = $mascota->getEdad();
                $parametros["raza"] = $mascota->getRaza();
                $parametros["tamanio"] = $mascota->getTamanio();
                $parametros["observaciones"] = $mascota->getObservaciones();
                $parametros["dni_duenio"] = $mascota->getDni_duenio();
                $parametros["foto"] = $mascota->getFoto();
                $parametros["vacunacion"] = $mascota->getVacunacion();
                $parametros["video"] = $mascota->getVideo();
                
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
                    $mascota = $this->nuevaMascota($parametros);
                }
                return $mascota;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function last(){
            try{
                $resultado = $this->GetAll();
                $last = null;
                $last = array_pop($resultado);
                return $last;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function update(Mascota $mascota){
            try{
                $query = "DELETE FROM " . $this->tableName . " WHERE (dni_duenio = :dni_duenio) AND (nombre = :nombre);";
                $parametros["dni_duenio"] = $mascota->getDni_duenio();
                $parametros["nombre"] = $mascota->getNombre();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parametros);

                $this->Add($mascota);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

    }




?>