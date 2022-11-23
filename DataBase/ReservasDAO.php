<?php
    namespace DataBase;
    use Models\Reserva as Reserva;
    use DataBase\Connection as Connection;
    use FFI\Exception as Exception;
    use DataBase\GuardianDAO as GuardianDAO;

    class ReservaDAO{
        private $tableName = "reservas";
        private $connection;

        function Add(Reserva $reserva){
            try{
                $query = "INSERT INTO " . $this->tableName . " (dni_duenio, dni_guardian, nombre_mascota, id_reserva, fecha, hora, encuentro, estado) VALUES (:dni_duenio, :dni_guardian, :nombre_mascota, :id_reserva, :fecha, :hora, :encuentro, :estado)";
                $parametros["dni_duenio"] = $reserva->getDniDuenio();
                $parametros["dni_guardian"] = $reserva->getDniGuardian();
                $parametros["nombre_mascota"] = $reserva->getNombre_mascota();
                $parametros["id_reserva"] = $reserva->getId_reserva();
                $parametros["fecha"] = $reserva->getFecha();
                $parametros["hora"] = $reserva->getHora();
                $parametros["encuentro"] = $reserva->getEncuentro();
                $parametros["estado"] = $reserva->getEstado();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parametros);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function nuevaReserva($parametros){
            $reserva = new Reserva();
            $reserva->setDniDuenio($parametros["dni_duenio"]);
            $reserva->setDniGuardian($parametros["dni_guardian"]);
            $reserva->setNombre_mascota($parametros["nombre_mascota"]);
            $reserva->setId_reserva($parametros["id_reserva"]);
            $reserva->setFecha($parametros["fecha"]);
            $reserva->setHora($parametros["hora"]);
            $reserva->setEncuentro($parametros["encuentro"]);
            $reserva->setEstado($parametros["estado"]);
            return $reserva;
        }

        function GetAll(){
            try{
                $reservas = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $lista = $this->connection->Execute($query);
                foreach($lista as $r){ //d es un array
                    $nuevaReserva = $this->nuevaReserva($r);
                    array_push($reservas, $nuevaReserva);}
                return $reservas;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function getById($id){
            try{
                $query = "SELECT * FROM " . $this->tableName . " WHERE (id_reserva = :id_reserva);";
                $parametro["id_reserva"] = $id;
                $this->connection = Connection::GetInstance();
                $resultado = $this->connection->Execute($query, $parametro);
                $reserva = null;

                if($resultado){
                    $parametros = $resultado[0]; //matriz de una sola fila 
                    $reserva = $this->nuevaReserva($parametros);
                }
                return $reserva;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function updateEstado($id, $estado){
            try{
                $query = "UPDATE " . $this->tableName . " SET estado = :estado WHERE id_reserva = :id_reserva";
                $parametros["estado"] = $estado;
                $parametros["id_reserva"] = $id;
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parametros);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function getByDniUser($dni){
            $user = $_SESSION["loggeduser"];
            $reservas = array();
            $resultado = array();
            try{
                if($user->getType() == 'd'){
                    $query = "SELECT * FROM " . $this->tableName . " WHERE (dni_duenio = :dni_duenio);";
                    $parametro["dni_duenio"] = $dni;
                    $this->connection = Connection::GetInstance();
                    $resultado = $this->connection->Execute($query, $parametro);
                }
                if($user->getType() == 'g'){
                    $query = "SELECT * FROM " . $this->tableName . " WHERE (dni_guardian = :dni_guardian);";
                    $parametro["dni_guardian"] = $dni;
                    $this->connection = Connection::GetInstance();
                    $resultado = $this->connection->Execute($query, $parametro);
                }
                foreach($resultado as $r){
                    array_push($reservas,$r);
                }
                return $reservas;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        private function reservasConcretadas(){
            try{
                $query = "UPDATE " . $this->tableName . " SET estado = 'servicio realizado' WHERE estado = 'programada' AND fecha < CURRENT_DATE()";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);

                $guardianDAO = new GuardianDAO();
                $guardianDAO->reservasConcretadas();
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        private function Update(){
            try{

                
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }


?>