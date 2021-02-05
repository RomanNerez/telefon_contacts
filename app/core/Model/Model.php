<?php

class Model extends DataBase
{
    protected $table;
    protected $sql;

    public function __construct()
    {
        parent::__construct();
        $this->table = mb_strtolower(static::class);
    }

    public function order(string $column, string $order = 'ASC'): Model
    {
        $this->sql = ' ORDER BY '.$column.' '.$order;
        return $this;
    }

    public function all(string $order = 'DESC'): PDOStatement
    {
        $sql = 'SELECT * FROM '.$this->table.$this->sql;
        return $this->db->query($sql);
    }

    public function whereLike(string $column, string $like = ''): Model
    {
        $this->sql = ' WHERE '.$column." LIKE '$like%'";
        return $this;
    }

    public function where(string $column, $value): Model
    {
        $this->sql = ' WHERE '.$column."=".$value;
        return $this;
    }

    public function delete()
    {
        $sql = 'DELETE FROM '.$this->table.$this->sql;
        return $this->db->query($sql);
    }

    public function insert(array $data)
    {
        if (!is_array($data) && !empty($data)) {
            throw new Exception('Insert value must be array');
        }

        $columns = join(',', array_unique(array_keys($data)));
        $sql = '';

        foreach ($data as $value) {
            $sql .= '"'.$value.'"';
            if (next($data)) {
                $sql.= ',';
            }
        }

        $sql = 'INSERT INTO '.$this->table.' ('.$columns.') VALUES ('.$sql.')';

        return $this->db->query($sql);
    }

    public function update(array $values)
    {
        if (!is_array($values) && !empty($values)) {
            throw new Exception('Update value must be array');
        }

        $sql = 'UPDATE '.$this->table.' SET ';

        foreach ($values as $key => $value) {
            $sql .= ' '.$key.'='.'"'.$value.'"';
            if (next($values)) {
                $sql.= ',';
            }
        }

        $sql.= $this->sql;

        return $this->db->query($sql);
    }

}