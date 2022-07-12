<?php
namespace frameworkVendor;
use frameworkVendor\Singleton;

class ConnectionDBUsers extends Singleton
{
    private static $obj;
    protected $pdo;

    protected function __construct()
    {
        $dbConfigInfo = require(ROOT . '/config/dbLogin_cnfg.php');
        $DBUser = $dbConfigInfo['providedDBUser'];
        $DBHost = $dbConfigInfo['providedDBHost'];
        $DBPwd = $dbConfigInfo['providedDBPwd'];
        $DBName = $dbConfigInfo['providedDBName'];

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



