<?php
session_start();
//echo "_SESSION";
//dd($_SESSION);
//$_POST = [
//    "providedDBUser" => "root",
//    "providedDBHost" => "a_level_mysql",
//    "providedDBPwd" => "antons",
//    "providedDBName" => "project_php",
//    "providedTableName" => "data",
//    "providedColumnName" => "string"
//];

echo "POST <br>";
dd($_POST);
echo "<br>";
echo "--------------------<br>";
echo "Files <br>";
dd($_FILES);
echo "<br>";
echo "---------------<br>";


//создаём новую базу которая будет хранить информацию с трех источников
echo "print_r($totalArray);";
//dd($totalArray);
$totalArray = new DataBase();

if ($_SESSION['arrData']) {
    foreach ($_SESSION['arrData'] as $item) {
        $totalArray->add_elem($item[0], $item[1]);
    }
}
//echo "print_r(totalArray) после добавления;";
//dd($totalArray);

extract($_POST);

//класс для одиночного подключения
class DB_fromSQL
{
    private static $obj;

    function __construct($DBHost, $DBName, $DBUser, $DBPwd, $tableName)
    {
        try {
            $this->con = new PDO (
                "mysql:host=$DBHost;dbname=$DBName", $DBUser, $DBPwd);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public static function createConnectBD($DBHost, $DBName, $DBUser, $DBPwd, $tableName)
    {
        if (!is_object(self::$obj)) {
            self::$obj = new DB_fromSQL($DBHost, $DBName, $DBUser, $DBPwd, $tableName);
        }
        return self::$obj;
    }

}


//класс содержащий все данные
class DataBase
{
    public $arrData = array();
    static $indexElem = 0;

    public function add_elem($typeSource, $str)
    {
        array_push($this->arrData, [$typeSource, $str]);
        static::$indexElem++;
        $_SESSION['arrData'] = $this->arrData;
//        echo "сессия";
//        dd($_SESSION);
        return $_SESSION['arrData'];
    }
}

function dd($el)
{
    echo "<pre>";
    print_r($el);
    echo "</pre>";
}

// функция добавляем в базу все элементы с таблицы, столбец providedColumnName
/**
 * @param $arrElements - таблица в БД с какой добавлять
 * @param $providedColumnName - колонка в таблице, которую добавлять
 * @param $arrTotal - куда добавлять
 * @return void
 */
function addTotalArrSQL($arrElements, $providedColumnName, $arrTotal)
{
    foreach ($arrElements as $item) {
//    echo "<br>Вытаскиваем строку $key <br>";
//    echo "<br>Добавляем в общий массив через класс  <br>";
        $arrTotal->add_elem("SQL DataBase", $item[$providedColumnName]);
    }
}

//выводим таблицу общий массив в формате HTML
function showArray()
{
    echo "<link rel='stylesheet' href='../styles.css'>";
    echo "<table>
    <tr>
    <th>Source</th>
    <th>Value</th>
  </tr>";
    foreach ($_SESSION['arrData'] as $str) {
        echo "<tr>";
        echo "<td>$str[0]</td><td>$str[1]</td>";
        echo "</tr> ";
    }
}

//echo "Подключились к базе:";
$dbSQL = DB_fromSQL::createConnectBD($providedDBHost, $providedDBName, $providedDBUser, $providedDBPwd, $providedTableName);

//echo "получили все элементы таблицы в elementsDB";
$elementsDB = $dbSQL->con->query("SELECT * FROM data;")->fetchAll();

//добавили в общую таблицу $totalArray строки из БД_SQL
addTotalArrSQL($elementsDB, $providedColumnName, $totalArray);

//открываем файл 1 тхт
if ($_FILES['providedTXT']['name']) {
    $filename = "./files/" . $_FILES['providedTXT']['name'];
    $myfile = fopen($filename, "r+") or die("Не удается открыть файл!");

//получаем из файла строки и записываем их в БД
    while (!feof($myfile)) {
        $lineTxt = fgets($myfile, filesize($filename));
        if ($lineTxt) $totalArray->add_elem("txt_file", $lineTxt);
    }
//закрываем файл
    fclose($myfile);
}

//открываем файл 2 csv
if ($_FILES['providedCSV']['name']) {
    $filename = "./files/" . $_FILES['providedCSV']['name'];
    $myfile = fopen($filename, "r+") or die("Не удается открыть файл!");

//получаем из файла строки и записываем их в БД
    while (!feof($myfile)) {
        $lineTxt = fgets($myfile, filesize($filename));
        if ($lineTxt) $totalArray->add_elem("CSV_file", $lineTxt);
    }
//закрываем файл
    fclose($myfile);
}

showArray($totalArray);


echo "<button class='btn' id='buttonGoAddData' onclick=redirect('newData.php')> + </button > ";
echo "<button class='btn' id='buttonGoSetting' onclick=redirect('settings.php')> S </button > ";
echo "<script> let redirect=(url) => location.href=url </script>";