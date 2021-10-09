<?php 
namespace App\Core;

use PDO;

class Model
{
    public $tableName = '';
    public $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=$_ENV[dbhost];dbname=$_ENV[dbname];charset=$_ENV[dbcharset]";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $_ENV['dbuser'], $_ENV['dbpassword'], $opt);
        if(empty($this->tableName))
        {
            $this->tableName = strtolower(__CLASS__) . "s_table";
        }
    }

    public function all()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function query($sql, $vars = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($vars);
        return $stmt;
    }
}

?>