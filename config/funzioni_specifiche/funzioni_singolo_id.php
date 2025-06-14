<?php


//QUESTE FUNZIONI SONO DA RIPORTARE IN PARTECIPANTI.PHP
//INSERIRE LE FUNZIONI NELLA CLASSE PARTECIPANTI


//SELEZIONA PARTECIPANTE DOVE è PRESENTE UNO SPECIFICO ID
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

?>