<?php

$dtb = new Database();
$connessione = $dtb->getConnection();

class totalePartecipanti{
    public $totalePartecipanti;
    private $conn;



public function __construct($db){
    $this -> conn = $db;
}

function visTotalePartecipanti(){
    $query = "SELECT sum(Totale_partecipanti) FROM (SELECT Totale_partecipanti FROM aggiornamenti ORDER BY Data_login DESC LIMIT 2) as seconda";
    $stmt = $this -> conn -> prepare($query);
    $stmt -> execute();
    return $stmt;
}


function ultimo(){
    $query = "SELECT Totale_partecipanti FROM aggiornamenti ORDER BY Data_login DESC LIMIT 1";
    $stmt = $this -> conn -> prepare($query);
    $stmt -> execute();
    return $stmt;
}

function inserisciPartData(){
    $query = "INSERT INTO aggiornamenti(Totale_partecipanti) VALUES (:insTotalePartecipanti)";
    $stmt = $this -> conn -> prepare($query);
    $stmt -> bindParam(":insTotalePartecipanti", $this->totalePartecipanti);
    $stmt->execute();
    return $stmt;	
}


}