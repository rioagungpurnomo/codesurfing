<?php

class CS_Model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function resultSet()
    {
        return $this->db->resultSet();
    }

    public function single()
    {
        return $this->db->single();
    }

    public function bind($field, $contents)
    {
        $this->db->bind($field, $contents);
    }

    public function execute()
    {
        $this->db->execute();
    }

    public function rowCount()
    {
        return $this->db->rowCount();
    }

    public function query($query)
    {
        $this->db->queryAll($query);
    }

    public function insert($table, $data)
    {
        $this->db->getInsertModel($table, $data);
        foreach ($data as $key => $value) {
            $this->db->bind(":$key", $value);
        }
        $this->execute();
        return $this->rowCount();
    }

    public function update($table, $data, $where = [])
    {
        $this->db->getUpdateModel($table, $data, $where);
        foreach ($data as $key => $value) {
            $this->db->bind(":$key", $value);
        }
        $this->db->bind('contents', $where[1]);
        $this->execute();
        return $this->rowCount();
    }

    public function get($table)
    {
        $this->db->getAllModel($table);
        return $this->db->resultSet();
    }

    public function where($table, $where = [])
    {
        $this->db->getAllWhereModel($table, $where);
        $this->db->bind('contents', $where[1]);
    }

    public function delete($table, $where = [])
    {
        $this->db->getDeleteModel($table, $where);
        $this->db->bind('contents', $where[1]);
        $this->execute();
        return $this->rowCount();
    }

    public function orderBy($table, $order_by)
    {
        $this->db->getAllOrderByModel($table, $order_by);
        return $this->db->resultSet();
    }

    public function where_orderBy($table, $order_by, $where = [])
    {
        $this->db->getAllWhereOrderByModel($table, $order_by, $where);
        $this->db->bind('contents', $where[1]);
        return $this->db->resultSet();
    }

    public function count($table)
    {
        $this->db->getCountModel($table);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function whereNot($table, $where = [])
    {
        $this->db->getAllWhereNotModel($table, $where);
        $this->db->bind('contents', $where[1]);
    }

    public function whereNot_orderBy($table, $order_by, $where = [])
    {
        $this->db->getAllWhereNotOrderByModel($table, $order_by, $where);
        $this->db->bind('contents', $where[1]);
        return $this->db->resultSet();
    }

    public function search($table, $where = [])
    {
        $this->db->getAllSearchModel($table, $where);
        $this->db->bind('keyword', $where[1]);
        return $this->db->resultSet();
    }

    public function search_orderBy($table, $order_by, $keyword = [])
    {
        $this->db->getAllSearchOrderByModel($table, $order_by, $keyword);
        $this->db->bind('keyword', "%$keyword[1]%");
        return $this->db->resultSet();
    }
}
