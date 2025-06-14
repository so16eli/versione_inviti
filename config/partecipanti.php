<?php

$dtb = new Database();
$connessione = $dtb->getConnection();

class Partecipanti{

    //VARIABILI PER PARTECIPANTE
    public $id;
    public $nomeECognome;
    public $alimentazione;
    public $bisognoPassaggio;
    public $eta;

    public $partecipa;
    public $nuovi;
    public $messaggio;
    
    public $dataCompilazione;
    private $conn;



public function __construct($db){
    $this -> conn = $db;
}

//PAGINA GESTIONE
//ELENCA TUTTI I PARTECIPANTI STANDARD (ANDARE IN TABELLA_GESTIONE_PARTECIPANTI IN FUNZIONI SPECIFICHE PER ELENCO ORDINATO PER DATA)
function visualizzPartecipanti(){
    $query = "SELECT * FROM partecipanti";
    $stmt = $this -> conn -> prepare($query);
    $stmt -> execute();
    return $stmt;
}

//INSERISCE PARTECIPANTE TRAMITE FORM
function inserisci(){
    
    $query = "INSERT INTO partecipanti(Nome_cognome, Partecipazione, Esigenze_alimentari, Bisogno_passaggio, Eta_minori, Data_compilazione) VALUES (:nomeCognome, :partecipazione, :eccezAlimentazione, :passaggio, :eta_Minori, :dataForm)";
    $stmt = $this -> conn -> prepare($query);
    $stmt -> bindParam(":nomeCognome", $this->nomeECognome);
    $stmt -> bindParam(":partecipazione", $this->partecipa);

    $stmt -> bindParam(":eccezAlimentazione", $this->alimentazione);
    $stmt -> bindParam(":passaggio", $this->bisognoPassaggio);
    $stmt -> bindParam(":eta_Minori", $this->eta);

    $stmt -> bindParam(":dataForm", $this->dataCompilazione);
    $stmt->execute();
    return $stmt;
}



}

?>