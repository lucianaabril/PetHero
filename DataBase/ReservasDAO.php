<?php
    namespace DataBase;
    use Models\Reserva as Reserva;
    use DataBase\Connection as Connection;

    class Reserva{
        private $tableName = "reservas";
        private $connection;

        function Add(Reserva $reserva){
            try{
                $query = "INSERT INTO " . $this->tableName . " (dni_duenio, dni_guardian, nombre_mascota, id_reserva, fecha, hora, encuentro, estado) VALUES ()"

            }
            catch(Exception $ex){
                throw $ex;
            }

        }
    }


?>