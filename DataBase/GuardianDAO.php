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
                $query = "INSERT INTO " . $this->tableName . " (dni_guardian, email, password, type, nombre, apellido, telefono, direccion, cumpleanios, tarifa, preferencia) VALUES (:dni,:email,:password,:type,:nombre,:apellido,:telefono,:direccion,:cumpleanios,:tarifa,:preferencia);";
                $parametros["nombre"] = $guardian->getNombre();
                $parametros["apellido"] = $guardian->getApellido();
                $parametros["dni"] = $guardian->getDni();
                $parametros["telefono"] = $guardian->getTelefono();
                $parametros["direccion"] = $guardian->getDireccion();
                $parametros["cumpleanios"] = $guardian->getCumpleanios();
                $parametros["tarifa"] = $guardian->getTarifa();
                $parametros["preferencia"] = $guardian->getPreferencia();
                $parametros["cbu"] = $guardian->getCBU();
                $parametros["alias"] = $guardian->getAlias();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parametros);

                foreach($guardian->getDisponibilidad() as $fecha=>$disp)
                $query_disp = "INSERT INTO " . $this->tableDisp . " (dni_guardian,fecha,disponibilidad) VALUES (:dni_guardian,:fecha,:disponibilidad);";
                $parametros_pago["dni_guardian"] = $guardian->getDni();
                $parametros_pago["fecha"] = $fecha;
                $parametros_pago["disponibilidad"] = $disp;

                $this->connection->ExecuteNonQuery($query_pago, $parametros_pago);

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
                    $nuevoGuardian = $this->nuevoGuardian($g);
                    array_push($guardianes, $nuevoGuardian);
                } 
                return $guardianes;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function nuevoGuardian($parametros){
            $guardian = new Guardian();
            $guardian->setNombre($parametros["nombre"]);
            $guardian->setNombre($parametros["apellido"]);
            $guardian->setNombre($parametros["dni"]);
            $guardian->setNombre($parametros["telefono"]);
            $guardian->setNombre($parametros["direccion"]);
            $guardian->setNombre($parametros["cumpleanios"]);
            $guardian->setNombre($parametros["disponibilidad"]);
            $guardian->setNombre($parametros["tarifa"]);
            $guardian->setNombre($parametros["preferencia"]);
            $guardian->setNombre($parametros["cbu"]);
            $guardian->setNombre($parametros["alias"]);
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
                    $guardian = $this->nuevoGuardian($parametros);
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
                    $guardian = $this->nuevoGuardian($parametros);
                }
                return $guardian;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function Update(Guardian $guardian){
            try{
                $query = "DELETE * FROM " . $this->tableName . " WHERE (dni = :dni);";
                $parametro["dni"] = $guardian->getDni();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query,$parametro);

                $this->Add($guardian);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function reservasConcretadas(){
            try{
                $guardianes = $this->GetAll();
                foreach($guardianes as $g){
                    $query = "DELETE * FROM " .$this->tableDisp. " WHERE dni_guardian = :dni_guardian AND fecha < CURRENT_DATE();";
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