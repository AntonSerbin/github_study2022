<?php

namespace frameworkVendor;

use frameworkVendor\Singleton;
use models\login;

class ConnectionDBDataFromUser extends Singleton
{
    private static $obj;
    protected $pdo;

    protected function __construct()
    {
        $idUser = (int)$_SESSION['user']['id'];
        if ($idUser) {
            $dbConfigInfo = Login::readDataConnectionById($idUser);
        };
        if ($dbConfigInfo) {
//            echo "InformationDB from the BDUser <br>";
            $DBUser = $dbConfigInfo[0]['dbuser'];
            $DBHost = $dbConfigInfo[0]['dbhost'];
            $DBPwd = $dbConfigInfo[0]['dbpwd'];
            $DBName = $dbConfigInfo[0]['dbname'];
            $DBTable = $dbConfigInfo[0]['dbtable'];
            $DBColumn = $dbConfigInfo[0]['dbcolumn'];
        } else {
//            echo "InformationDB from the standard file <br>";
            $dbConfigInfo = require(ROOT . '/config/dbDataFromUser_cnfg.php');
            $DBUser = $dbConfigInfo['providedDBUser'];
            $DBHost = $dbConfigInfo['providedDBHost'];
            $DBPwd = $dbConfigInfo['providedDBPwd'];
            $DBName = $dbConfigInfo['providedDBName'];
            $DBTable = $dbConfigInfo['providedTableName'];
            $DBColumn = $dbConfigInfo['providedColumnName'];
        };

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        try {
            $dns = "mysql:host=$DBHost;dbname=$DBName;charset=utf8";
            $this->pdo = new \PDO($dns, $DBUser, $DBPwd, $options);
//            echo "Base successfully connected ConnectionDBDataFromUser  =  $DBHost <br>";

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



