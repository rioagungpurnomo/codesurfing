<?php

class Admin extends CS_Model
{
    public function count_data($table)
    {
        return $this->count($table);
    }

    public function visitors($ip, $visit)
    {
        $this->query("SELECT * FROM visitors WHERE ip = :ip AND visit = :visit");
        $this->bind('ip', $ip);
        $this->bind('visit', $visit);
        return $this->resultSet();
    }

    public function get_data($table, $order)
    {
        return $this->orderBy($table, $order);
    }

    public function get_where_not($table, $order, $where)
    {
        return $this->whereNot_orderBy($table, $order, $where);
    }

    public function get_where_orderby($table, $order, $where)
    {
        return $this->where_orderBy($table, $order, $where);
    }

    public function topThree()
    {
        $this->query("SELECT * FROM blog ORDER BY views DESC LIMIT 3");
        return $this->resultSet();
    }

    public function topSix()
    {
        $this->query("SELECT * FROM blog ORDER BY id DESC LIMIT 6");
        return $this->resultSet();
    }

    public function insert_data($table, $data)
    {
        $this->insert($table, $data);
    }

    public function update_data($table, $data, $where)
    {
        $this->update($table, $data, $where);
    }

    public function details_data($table, $where)
    {
        $this->where($table, $where);
        return $this->single();
    }

    public function delete_data($table, $data)
    {
        $this->delete($table, $data);
    }

    public function get_search($table, $order_by, $where)
    {
        return $this->search_orderBy($table, $order_by, $where);;
    }
}
