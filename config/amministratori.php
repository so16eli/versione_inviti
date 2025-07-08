<?php

$dtb = new Database();
$connessione = $dtb->getConnection();

class Amministratore{
    public $nome;
    public $email;
    public $psw;
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * from amministratori";
        $stmt = $this->conn->prepare($query);
        $stmt -> execute();
        return $stmt;
    }

    function createAdmin(){
    	try{
        $query = "INSERT INTO amministratori(nome, email, psw) VALUES(:nome, :email, :psw)";
        $stmt = $this->conn->prepare($query);
        $stmt -> bindParam(':nome', $this->nome);
        $stmt -> bindParam(':email', $this->email);
        $stmt -> bindParam(':psw', $this->psw);
		
        
            if($stmt -> execute()){
            	return true;
            }
            else{
            	$errore = $stmt->errorInfo();
            	return "Errore". $errore[2];
            }
                  
        }
        catch (PDOException $e){
        	return "Errore". $e->getMessage();
        }
        
    }
}

?>