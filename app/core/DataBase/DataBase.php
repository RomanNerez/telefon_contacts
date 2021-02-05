<?php

require_once __DIR__.DS.'Connection.php';

class DataBase
{
    public $db;

    public  function __construct()
    {
        $this->db = Connection::getInstance();
    }


}