<?php
    namespace DataBase;
    use Models\Guardian as Guardian;
    use DataBase\Connection as Connection;
    use FFI\Exception as Exception;

    class GuardianDAO{
        private $connection;
        private $tableName = "guardianes";
        private $tableDisp = "disponibilidades";

        function Add(Guardian $guardian){
            try{
                $query = "INSERT INTO " . $this->tableName . " (dni_guardian, email, password, type, nombre, apellido, telefono, direccion, cumpleanios, tarifa, preferencia, cbu, alias) VALUES (:dni,:email,:password,:type,:nombre,:apellido,:telefono,:direccion,:cumpleanios,:tarifa,:preferencia,:cbu,:alias);";
                $parametros["dni"] = $guardian->getDni();
                $parametros["email"] = $guardian->getEmail();
                $parametros["password"] = $guardian->getPassword();
                $parametros["type"] = $guardian->getType();
                $parametros["nombre"] = $guardian->getNombre();
                $parametros["apellido"] = $guardian->getApellido();
                $parametros["telefono"] = $guardian->getTelefono();
                $parametros["direccion"] = $guardian->getDireccion();
                $parametros["cumpleanios"] = $guardian->getCumpleanios();
                $parametros["tarifa"] = $guardian->getTarifa();
                $parametros["preferencia"] = $guardian->getPreferencia();
                $parametros["cbu"] = $guardian->getCBU();
                $parametros["alias"] = $guardian->getAlias();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parametros);

                foreach($guardian->getDisponibilidad() as $fecha=>$disp){
                    $query_disp = "INSERT INTO " . $this->tableDisp . " (dni_guardian,fecha,disponibilidad) VALUES (:dni_guardian,:fecha,:disponibilidad);";
                    $parametros_disp["dni_guardian"] = $guardian->getDni();
                    $parametros_disp["fecha"] = $fecha;
                    $parametros_disp["disponibilidad"] = $disp;
                    $this->connection->ExecuteNonQuery($query_disp, $parametros_disp);
                }
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function GetAll(){
            try{
                $guardianes = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultado = $this->connection->Execute($query);
                foreach($resultado as $g){ //g es una fila
                    $disp = $this->getDisponibilidad($g["dni_guardian"]);
                    $nuevoGuardian = $this->nuevoGuardian($g, $disp);
                    array_push($guardianes, $nuevoGuardian);
                } 
                return $guardianes;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function getDisponibilidad($dni_guardian){
            try{
                $query = "SELECT * FROM " . $this->tableDisp . " WHERE dni_guardian = :dni_guardian;";
                $parametro["dni_guardian"] = $dni_guardian;
                $this->connection = Connection::GetInstance();
                $resultado = null;
                $resultado = $this->connection->Execute($query, $parametro);
                $disp = null;

                if($resultado){
                    foreach($resultado as $r){
                        $disp[$r["fecha"]] = $r["disponibilidad"];
                    }
                }
                return $disp;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function nuevoGuardian($parametros, $disponibilidad){
            $guardian = new Guardian();
            $guardian->setDni($parametros["dni_guardian"]);
            $guardian->setEmail($parametros["email"]);
            $guardian->setPassword($parametros["password"]);
            $guardian->setType($parametros["type"]);
            $guardian->setNombre($parametros["nombre"]);
            $guardian->setApellido($parametros["apellido"]);
            $guardian->setTelefono($parametros["telefono"]);
            $guardian->setDireccion($parametros["direccion"]);
            $guardian->setCumpleanios($parametros["cumpleanios"]);
            $guardian->setTarifa($parametros["tarifa"]);
            $guardian->setPreferencia($parametros["preferencia"]);
            $guardian->setCBU($parametros["cbu"]);
            $guardian->setAlias($parametros["alias"]);

            if($disponibilidad){
                $guardian->newDisponibilidad($disponibilidad); //new setea el arreglo entero
            }                                                  //set agrega una fecha nueva al arreglo existente
            return $guardian;
        }

        function getByEmail($email){
            try{
                $query = "SELECT * FROM " . $this->tableName . " WHERE (email = :email);";
                $parametro["email"] = $email;
                $this->connection = Connection::GetInstance();
                $resultado = $this->connection->Execute($query,$parametro);
                $guardian = null;

                if($resultado){ //matriz resultado
                    $parametros = $resultado[0]; //único registro en arreglo
                    $disp = $this->getDisponibilidad($parametros["dni_guardian"]);
                    $guardian = $this->nuevoGuardian($parametros, $disp);
                }
                return $guardian;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function getByDni($dni){
            try{
                $query = "SELECT * FROM " . $this->tableName . " WHERE (dni_guardian = :dni);";
                $parametro["dni"] = $dni;
                $this->connection = Connection::GetInstance();
                $resultado = $this->connection->Execute($query,$parametro);
                $guardian = null;

                if($resultado){
                    $parametros = $resultado[0];
                    $disp = $this->getDisponibilidad($parametros["dni_guardian"]); //¿
                    $guardian = $this->nuevoGuardian($parametros, $disp);
                }
                return $guardian;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function Update(Guardian $guardian){
            try{
                $query = "UPDATE " . $this->tableName . " SET email=:email,password=:password,nombre=:nombre,apellido=:apellido,telefono=:telefono,direccion=:direccion,cumpleanios=:cumpleanios,tarifa=:tarifa,preferencia=:preferencia,cbu=:cbu,alias=:alias WHERE (dni_guardian = :dni_guardian);";
                $parametro["email"] = $guardian->getEmail();
                $parametro["password"] = $guardian->getPassword();
                $parametro["nombre"] = $guardian->getNombre();
                $parametro["apellido"] = $guardian->getApellido();
                $parametro["telefono"] = $guardian->getTelefono();
                $parametro["direccion"] = $guardian->getDireccion();
                $parametro["cumpleanios"] = $guardian->getCumpleanios();
                $parametro["tarifa"] = $guardian->getTarifa();
                $parametro["preferencia"] = $guardian->getPreferencia();
                $parametro["cbu"] = $guardian->getCBU();
                $parametro["alias"] = $guardian->getAlias();
                $parametro["dni_guardian"] = $guardian->getDni();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query,$parametro);

                foreach($guardian->getDisponibilidad() as $fecha=>$disp){
                    $query_disp = "INSERT INTO " . $this->tableDisp . " (dni_guardian,fecha,disponibilidad) VALUES (:dni_guardian,:fecha,:disponibilidad);";
                    $parametros_disp["dni_guardian"] = $guardian->getDni();
                    $parametros_disp["fecha"] = $fecha;
                    $parametros_disp["disponibilidad"] = $disp;
                    $this->connection->ExecuteNonQuery($query_disp, $parametros_disp);
                }
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function reservasConcretadas(){
            try{
                $guardianes = $this->GetAll();
                foreach($guardianes as $g){
                    $query = "DELETE FROM " .$this->tableDisp. " WHERE dni_guardian = :dni_guardian AND fecha < CURRENT_DATE();";
                    $parametro["dni_guardian"] = $g->getDni();
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query,$parametro);
                }
            }
            catch(Exception $ex){
                throw $ex;
            }
        }


    }




?>