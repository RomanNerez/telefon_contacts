<?php

class Connection
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (static::$instance === null) {
            try {
                $dsn = DATABASE.':host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME;
                static::$instance = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
                static::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                static::$instance->query('SET NAMES utf8');
                static::$instance->query('SET CHARACTER SET utf8');
            } catch(PDOException $error) {
                echo $error->getMessage();
            }
        }

        return static::$instance;
    }

    private function __construct()
    {

    }
}