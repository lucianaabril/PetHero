<?php
namespace DataBase;
use PDO as PDO;
use DataBase\QueryType as QueryType;

class Connection{
    private $pdo = null;
    private $pdoStatement = null;
    private static $instance = null;

    function __construct()
    {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function GetInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function Execute($query, $parameters = array(), $queryType = QueryType::Query)
    {
        $this->Prepare($query);
        $this->BindParameters($parameters, $queryType);
        $this->pdoStatement->execute();
        return $this->pdoStatement->fetchAll();
    }

    public function ExecuteNonQuery($query, $parameters = array(), $queryType = QueryType::Query)
    {
        $this->Prepare($query);
        $this->BindParameters($parameters, $queryType);
        $this->pdoStatement->execute();
        return $this->pdoStatement->rowCount();
    }

    private function Prepare($query)
    {
        $this->pdoStatement = $this->pdo->prepare($query);
    }

    private function BindParameters($parameters = array(), $queryType = QueryType::Query)
    {
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
}

?>