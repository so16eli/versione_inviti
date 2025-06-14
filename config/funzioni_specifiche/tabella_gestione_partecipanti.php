<?php

//QUESTE FUNZIONI SONO DA RIPORTARE IN PARTECIPANTI.PHP
//INSERIRE LE FUNZIONI NELLA CLASSE PARTECIPANTI


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

?>