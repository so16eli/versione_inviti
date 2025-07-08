<?php
class Database{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_nome = "matrimonio";
    public $db;


public function getConnection() {
    $this ->db = null;
    try{
        $this -> db = new PDO("mysql:host=".$this ->host.";dbname=".$this ->db_nome.";charset=utf8", $this ->username, $this ->password);
    }
    catch(PDOException $exception){
        echo "Errore di connessione:". $exception->getMessage();
    }
    return $this ->db;
}

}

?>