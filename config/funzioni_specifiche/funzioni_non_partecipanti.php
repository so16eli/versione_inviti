<?php

//QUESTE FUNZIONI SONO DA RIPORTARE IN PARTECIPANTI.PHP
//INSERIRE LE FUNZIONI NELLA CLASSE PARTECIPANTI

//INSERISCE MESSAGGIO PER I NON PARTECIPANTI, INSERISCE IL MESSAGGIO NELL'ULTIMO ID INSERITO
function inserisciMessaggio(){
   
    $query = "INSERT INTO messaggi(Id_nonPartecipante,Messaggio) SELECT LAST_INSERT_ID(), :messaggio";
    $stmtMSG = $this -> conn -> prepare($query);
    $stmtMSG -> bindParam(":messaggio", $this->messaggio);

    $stmtMSG -> execute();
    return $stmtMSG;

}


//LEGGE I NOMI PARTECIPANTI, LA NON PARTECIPAZIONE E IL MESSAGGIO DEI NON PARTECIPANTI CORRELANDO LE TABELLE DEI PARTECIPANTI E DEI MESSAGGI
function selezioneMessaggi(){
    $query = "SELECT partecipanti.Nome_cognome, partecipanti.Partecipazione, messaggi.Messaggio FROM partecipanti INNER JOIN messaggi ON messaggi.Id_nonPartecipante=partecipanti.Id";
    $stmt= $this->conn->prepare($query);
    $stmt -> execute();
    return $stmt;
}



?>