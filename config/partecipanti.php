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



//COMMENTARE IN SEGUITO
    // CODICE PRESENTE IN ALTRI FILE
function selezioneDaId(){
    $query = "SELECT * FROM partecipanti WHERE Id=:id";
    $stmt = $this->conn->prepare($query);
    $stmt -> bindParam(":id", $this->id);
    $stmt -> execute();
    return $stmt;
}

//CANCELLA PARTECIPANTE UTENTE CON SPECIFICO ID
function cancellaDaId(){
    $query = "DELETE FROM partecipanti WHERE Id=:id";
    $stmt = $this->conn->prepare($query);
    $stmt -> bindParam(":id", $this->id);
    $stmt -> execute();
    return $stmt;   
}

//ANNULLA PARTECIPAZIONE, SETTANDO PARTECIPAZIONE SU NO, DI UTENTE CON SPECIFICO ID
function AnnullaPartecipazione(){
    $query = "UPDATE partecipanti SET Partecipazione='No' WHERE Id=:id";
    $stmt = $this->conn->prepare($query);
    $stmt -> bindParam(":id", $this->id);
    $stmt -> execute();
    return $stmt;   
}

//LEGGE TUTTI I PARTECIPANTI ORDINANDO PER DATA
function elenco(){
    $query = "SELECT * FROM partecipanti WHERE Id ORDER BY SUBSTRING(Data_compilazione, 3, 4) DESC, SUBSTRING(Data_compilazione, 1, 2) DESC, SUBSTRING(Data_compilazione, 12, 13) DESC, SUBSTRING(Data_compilazione, 15, 16) DESC";
    $stmt = $this->conn->prepare($query);
    $stmt -> execute();
    return $stmt;	
}



//SELEZIONA GLI ULTIMI PARTECIPANTI ORDINANDO I RISULTATI E LIMITANDO IL NUMERO DI RISULTATI TRAMITE $NUOVI
function selezionePrima($nuovi){
    $query = "SELECT * FROM partecipanti ORDER BY SUBSTRING(Data_compilazione, 3, 4) DESC, SUBSTRING(Data_compilazione, 1, 2) DESC, SUBSTRING(Data_compilazione, 12, 13) DESC, SUBSTRING(Data_compilazione, 15, 16) DESC LIMIT $nuovi";
    $stmt = $this->conn->prepare($query);
    $stmt -> execute();
    return $stmt;	
}


//FINE CODICE PRESENTE IL ALTRI FILE DA CANCELLARE

}

?>