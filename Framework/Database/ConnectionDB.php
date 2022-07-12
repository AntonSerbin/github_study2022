<?php

namespace Framework\Database;

use Framework\Database\Singleton;

class ConnectionDB extends Singleton
{
    private static $obj;
    protected $pdo;

    public function __construct()
    {
        $DBUser = $_ENV['PROVIDED_DB_USER'];
        $DBHost = $_ENV['PROVIDED_DB_HOST'];
        $DBPwd = $_ENV['PROVIDED_DB_PWD'];
        $DBName = $_ENV['PROVIDED_DB_NAME'];

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        try {
            $dns = "mysql:host=$DBHost;dbname=$DBName;charset=utf8";
            $this->pdo = new \PDO($dns, $DBUser, $DBPwd, $options);
//            echo "Base successfully connected<br>";
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }

}