<?php

namespace Framework\Database;

use Framework\Database\ConnectionDB;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\Console\Helper\Table;
use function Symfony\Component\String\s;


abstract class ModelDB
{
    protected string $table;
    private string $sqlStr = "";
    private bool $whereAdded = false;
    private $pdo;

    public function __construct()
    {
        $this->pdo = ConnectionDB::getInstance()->getPdo();
    }


   public function save()
    {
        $fields = $this->getFields();
        $strFields = "";
        $strValues = ") VALUES(";
        $sqlStr = "INSERT INTO " . $this->table . "(";
        foreach ($fields as $key => $value) {
            if (!isset($this->$key)) {
                continue;
            }
            $strFields .= $key . ",";
            $strValues .= "'".$this->$key . "',";
        };
        $strFields = rtrim($strFields, ",");
        $strValues = rtrim($strValues, ",");

        $sqlStr .= $strFields . $strValues . ");";
        $insertStatement = $this->pdo->prepare($sqlStr);
        if ($insertStatement->execute()
        ) {
//            echo "New data  added to DB successfully";
            $this->id = $this->pdo->lastInsertId();
            return $this;
        } else {
//            echo "Unable to create user record";
        }
        return true;
    }

    public function join($table2, $column1, $column2)
    {

        $this->sqlStr .= "INNER JOIN " . $table2 . " ON " . $column1 . "=" . $column2 . " ";

        return $this;
    }

    public function where($key, $value)
    {
        if (!$this->whereAdded) {
            $this->sqlStr .= " WHERE " . $key . " = '" . $value . "'";
        }
        if ($this->whereAdded) {
            $this->sqlStr .= " AND " . $key . " = '" . $value . "'";
        }

        $this->whereAdded = true;
        return $this;
    }

    public function select($value = "*")
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "SELECT " . $value . " FROM " . $this->table . " " . $this->sqlStr;
        $elementsDB = $pdo->query($sqlStr)->fetchAll();
        $this->sqlStr = "";
        return $elementsDB;
    }

    public function showTable()
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
//        dd("select * from $name");
        $elementsDB = $pdo->query("select * from $this->table")->fetchAll();

        return $elementsDB;
    }

    public function read($column, $elem)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
//        dd("select * from $table where $column = '$elem';");
        $elementsDB = $pdo->query("select * from " . $this->table . " where $column = '$elem';")->fetchAll();
        return $elementsDB;
    }

    public function write($column, $elem)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
//        echo $this->table, $column, $elem . '<br>';
//        $sqlStr = "INSERT INTO '"."$table' ('"."$column') VALUE ('"."$elem');";
        $sqlStr = "INSERT INTO " . $this->table . " $column VALUES (" . "'" . $elem . "');";

        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
//            echo "New data  added to DB successfully";
            return true;
        } else {
//            echo "Unable to create user record";
//            die();
        }
        return true;
    }


    public function find($column, $elem, $requestColumn)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "select " . $column . " from " . $this->table . " where $elem ='" . $requestColumn . "';";
        $elementsDB = $pdo->query($sqlStr)->fetchAll();
        return $elementsDB;
    }


    public function readLastString()
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "select * from $this->table ORDER BY ID DESC LIMIT 1";
        $elementsDB = $pdo->query($sqlStr)->fetchAll();
        return $elementsDB;
    }


    public function update($column, $elem, $whereColumn, $whereElem)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
//        echo $table, $column, $elem , $whereColumn, $whereElem,'<br>';
        $sqlStr = "UPDATE " . $this->table . " SET $column = '" . $elem . "' WHERE ($whereColumn='" . $whereElem . "');";
        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
//            echo "New data  added to DB successfully";
            return true;
        } else {
//            echo "Unable to create user record";
//            die();
        }
        return true;
    }

    public function truncate()
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "TRUNCATE TABLE " . $this->table;
        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
//            echo "Table truncated ";
            return true;
        } else {
//            echo "Unable to create user record";
            die();
        }
        return true;
    }

    public function delete($column, $el)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "TRUNCATE TABLE " . $this->table;
        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
//            echo "Table truncated ";
            return true;
        } else {
//            echo "Unable to create user record";
            die();
        }
        return true;
    }

    public function writeStr($arr)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "INSERT INTO $this->table (";
        foreach ($arr as $key => $value) {
            $sqlStr .= "$key" . ", ";
        };
        $sqlStr = substr($sqlStr, 0, -2) . ") VALUES (";
        foreach ($arr as $key => $value) {
            $sqlStr .= "'$value" . "',";
        };
        $sqlStr = substr($sqlStr, 0, -1) . ");";

        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
//            echo "New data  added to DB successfully";
            return true;
        } else {
//            echo "Unable to create user record";
//            die();
        }
        return true;
    }

    public function getFields(): array
    {
        $notDBFields = array_keys(get_class_vars(__CLASS__));
        return array_filter(get_class_vars(get_called_class()), function ($key) use ($notDBFields) {
            if (!in_array($key, $notDBFields)) {
                return true;
            }
        }, ARRAY_FILTER_USE_KEY);
        die();

    }

}
