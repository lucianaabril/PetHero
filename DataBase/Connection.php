<?php
namespace DataBase;
use PDO as PDO;
use DataBase\QueryType as QueryType;
use FFI\Exception as Exception;

class Connection{
    private $pdo = null;
    private $pdoStatement = null;
    private static $instance = null;

    function __construct()
    {
        try{
            $this->pdo = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public static function GetInstance()
    {
        try{
            if (self::$instance == null) {
                self::$instance = new Connection();
            }
            return self::$instance;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function Execute($query, $parameters = array(), $queryType = QueryType::Query)
    {
        try{
            $this->Prepare($query);
            $this->BindParameters($parameters, $queryType);
            $this->pdoStatement->execute();
            return $this->pdoStatement->fetchAll();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function ExecuteNonQuery($query, $parameters = array(), $queryType = QueryType::Query)
    {
        try{
            $this->Prepare($query);
            $this->BindParameters($parameters, $queryType);
            $this->pdoStatement->execute();
            return $this->pdoStatement->rowCount();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    private function Prepare($query)
    {
        try{ $this->pdoStatement = $this->pdo->prepare($query); }
        catch(Exception $ex){ throw $ex; }
    }

    private function BindParameters($parameters = array(), $queryType = QueryType::Query)
    {
        try{
            $i = 0;
            foreach ($parameters as $parameterName=>$value) {
                $i++;
                if ($queryType == QueryType::Query){
                    $this->pdoStatement->bindParam(":" . $parameterName, $parameters[$parameterName]);
                }
                else {
                    $this->pdoStatement->bindParam($i, $parameters[$parameterName]);
                }
        }
        }
        catch(Exception $ex){
            throw $ex;
        }
        
    }
}

?>