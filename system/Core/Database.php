<?php

class Database
{
    private $dbh;
    private $stmt;

    public function __construct()
    {
        require_once 'app/Config/Database.php';

        $this->host = $database['db_host'];
        $this->user = $database['db_user'];
        $this->pass = $database['db_pass'];
        $this->db_name = $database['db_name'];

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function queryAll($queryAll)
    {
        $this->stmt = $this->dbh->prepare($queryAll);
    }

    public function getAllModel($table)
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM $table");
    }

    public function getAllOrderByModel($table, $order_by = [])
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM $table ORDER BY $order_by[0] $order_by[1]");
    }

    public function getAllWhereOrderByModel($table, $order_by = [], $where = [])
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM $table WHERE $where[0] =:contents ORDER BY $order_by[0] $order_by[1]");
    }

    public function getAllWhereNotOrderByModel($table, $order_by = [], $where = [])
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM $table WHERE NOT $where[0] =:contents ORDER BY $order_by[0] $order_by[1]");
    }

    public function getAllWhereModel($table, $where = [])
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM $table WHERE $where[0] =:contents");
    }

    public function getAllWhereNotModel($table, $where = [])
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM $table WHERE NOT $where[0] =:contents");
    }


    public function getDeleteModel($table, $where = [])
    {
        $this->stmt = $this->dbh->prepare("DELETE FROM $table WHERE $where[0] =:contents");
    }

    public function getCountModel($table)
    {
        $this->stmt = $this->dbh->query("SELECT * FROM $table");
    }

    public function getAllSearchModel($table, $where = [])
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM $table WHERE $where[0] LIKE :keyword");
    }

    public function getAllSearchOrderByModel($table, $order_by = [], $keyword = [])
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM $table WHERE $keyword[0] LIKE :keyword ORDER BY $order_by[0] $order_by[1]");
    }

    public function getInsertModel($table, $data)
    {

        ksort($data);

        $fieldNames = implode(',', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $this->stmt = $this->dbh->prepare("INSERT INTO $table ($fieldNames) VALUES ($fieldValues)");
    }

    public function getupdateModel($table, $data, $where = [])
    {

        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key = :$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $this->stmt = $this->dbh->prepare("UPDATE $table SET $fieldDetails WHERE $where[0] =:contents");
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
    public function columnCount()
    {
        return $this->stmt->columnCount();
    }
}
