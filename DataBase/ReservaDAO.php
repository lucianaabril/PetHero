<?php
    namespace DataBase;
    use Models\Reserva as Reserva;
    use Models\Pago as Pago;
    use DataBase\Connection as Connection;
    use FFI\Exception as Exception;
    use DataBase\GuardianDAO as GuardianDAO;

    class ReservaDAO{
        private $tableName = "reservas";
        private $connection;
        private $tablePago = "pago";

        function Add(Reserva $reserva){
            try{
                $query = "INSERT INTO " . $this->tableName . " (dni_duenio, dni_guardian, nombre_mascota, id_reserva, fecha, hora, encuentro, estado) VALUES (:dni_duenio, :dni_guardian, :nombre_mascota, :id_reserva, :fecha, :hora, :encuentro, :estado);";
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

                $query2 = "SELECT MAX(n_reserva) FROM " . $this->tableName;
                $n_reserva = $this->connection->Execute($query2);

                $query_pago = "INSERT INTO " . $this->tablePago . " (n_reserva, forma_pago, fecha, monto) VALUES (:n_reserva, :forma_pago, :fecha, :monto);";
                $parametros_pago["n_reserva"] = $n_reserva;
                $parametros_pago["forma_pago"] = $reserva->pago->getForma_pago();
                $parametros_pago["fecha"] = $reserva->pago->getFecha();
                $parametros_pago["monto"] = $reserva->pago->getMonto();

                $this->connection->ExecuteNonQuery($query_pago, $parametros_pago);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function nuevaReserva($parametros, $pago){
            $reserva = new Reserva();
            $reserva->setDniDuenio($parametros["dni_duenio"]);
            $reserva->setDniGuardian($parametros["dni_guardian"]);
            $reserva->setNombre_mascota($parametros["nombre_mascota"]);
            $reserva->setId_reserva($parametros["id_reserva"]);
            $reserva->setFecha($parametros["fecha"]);
            $reserva->setHora($parametros["hora"]);
            $reserva->setEncuentro($parametros["encuentro"]);
            $reserva->setEstado($parametros["estado"]);
            
            if($pago){
                $pagoNuevo = new Pago();
                $pagoNuevo->setForma_pago($pago->getForma_pago());
                $pagoNuevo->setFecha($pago->getFecha());
                $pagoNuevo->setMonto($pago->getMonto());
                $reserva->setPago($pagoNuevo);
            }
            return $reserva;
        }

        function GetAll(){
            try{
                $reservas = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $lista = $this->connection->Execute($query);
                foreach($lista as $r){ 
                    $pago = $this->getPago($r["n_reserva"]); //si no tiene pago viene en null
                    $nuevaReserva = $this->nuevaReserva($r, $pago);
                    array_push($reservas, $nuevaReserva);
                }
                return $reservas;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function getPago($n_reserva){
            try{
                $query = "SELECT * FROM " . $this->tablePago . " WHERE n_reserva = :n_reserva;";
                $parametro["n_reserva"] = $n_reserva;
                $this->connection = Connection::GetInstance();
                $resultado = null;
                $resultado = $this->connection->Execute($query, $parametro);
                $pago = null;

                if($resultado){
                    $pago = $this->nuevoPago($resultado);
                }
                return $pago;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function nuevoPago($parametros){
            $pagoNuevo = new Pago();
            if($parametros){
                $pagoNuevo->setForma_pago($parametros["forma_pago"]);
                $pagoNuevo->setFecha($parametros["fecha"]);
                $pagoNuevo->setMonto($parametros["monto"]);
            }
            return $pagoNuevo;
        }

        function getById($id){
            try{
                $query = "SELECT * FROM " . $this->tableName . " WHERE (id_reserva = :id_reserva);";
                $parametro["id_reserva"] = $id;
                $this->connection = Connection::GetInstance();
                $resultado = $this->connection->Execute($query, $parametro);
                $reservas = array();

                if($resultado){
                    foreach($resultado as $r){
                        $pago = $this->getPago($r["n_reserva"]);
                        $reserva = $this->nuevaReserva($r,$pago);
                        array_push($reservas,$reserva);
                    }
                }

                return $reservas;
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
                if($resultado){
                    foreach($resultado as $r){
                        $pago = $this->getPago($parametro["id_reserva"]);
                        $reserva = $this->nuevaReserva($r,$pago);
                        array_push($reservas,$reserva);
                    }
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

        function getLastId(){
            try{
                $resultado = $this->GetAll();
                $last = array_pop($resultado);
                if($last){
                    return $last->getId_reserva();
                }
                else{
                    return null;
                }
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        function Update($id_reserva, $fecha, $reserva){
            try{
                $query = "INSERT INTO " . $this->tablePago . "(id_reserva,fecha,forma_pago,monto) VALUES (:id_reserva,:fecha,:forma_pago,:monto);";
                $parametros["id_reserva"] = $id_reserva;
                $parametros["fecha"] = $fecha;
                $pago = $reserva->getPago();
                $parametros["forma_pago"] = $pago->getForma_pago();
                $parametros["monto"] = $pago->getMonto();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parametros);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }
?>