<html>
    <head>
        <link rel="stylesheet" href="css/stile.css">
    
    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </head>

<?php
    require '/membri/weddinginfomattemarty/config/config.php';
    require '/membri/weddinginfomattemarty/config/partecipanti.php';
    
    session_start();
    if(isset($_GET['id'])){
        $idSpecifico= $_GET['id'];
    }
    else{
        $idSpecifico =$_SESSION['idSpecifico']; 
    }
    $_SESSION['idSpecifico'] = $idSpecifico;

    $dab= new Database();
    $connessione = $dab -> getConnection();

    $azioniPartecipanti = new Partecipanti($connessione);
    $azioniPartecipanti -> id = $idSpecifico;
    $visualePrecedente = $azioniPartecipanti -> selezioneDaId();
    $uno  = $visualePrecedente->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['cancella'])){
        if(isset($_SESSION['idSpecifico'])){
        $idSpecifico = $_SESSION['idSpecifico'];
        $azioniPartecipanti -> id = $idSpecifico;

        $cancellazione = $azioniPartecipanti -> cancellaDaId();
        if($cancellazione){

            echo '<div class="popUp2" style="z-index:1;"> cancellazione effettuata correttamente
            </div>    
            </div>';
            
        ?>
            <script>
            setTimeout(function () {
                
            window.location.href= 'gestione.php'; // the redirect goes here

                },3000);
            </script>
        <?php
        }
        else { echo "è sorto qualche problema";
        } }

    }

    if(isset($_POST['annullaPart'])){
        if(isset($_SESSION['idSpecifico'])){

        $idSpecifico = $_SESSION['idSpecifico'];

        $azioniPartecipanti -> id = $idSpecifico;
        $ap = $azioniPartecipanti -> AnnullaPartecipazione();
        if($ap){
            echo '<div class="popUp2"  style="z-index:1;"> Ora la persona è indicata come non partecipante;
            </div>    
            </div>';
           
        ?>
            <script>
            setTimeout(function () {
                
            window.location.href= 'gestione.php'; // the redirect goes here

                },3000);
            </script>
        <?php
        } 
        else{
            echo "è sorto qualche problema";
        }
    }
    }
?>

    <body>
        <div class="gestioneArea">
            <img width="24" height="24" class= "arrow" onclick="history.back();" src="https://img.icons8.com/material-rounded/24/828340/arrow-pointing-left.png" alt="arrow-pointing-left"/>        

            <h3 style="font-size:16px;">PAGINA DEDICATA AL SINGOLO UTENTE</h3>
        </div>
        

        <div class="gestione">
            
        <table class="tableSI">
                <?php
                  //  foreach ($visualePrecedente as $singoloPartecipante) {
                            $id=$uno['Id'];
                            $nome_cognome=$uno['Nome_cognome'];
                            $partecipazione=$uno['Partecipazione'];
                            $esAlim=$uno['Esigenze_alimentari'];
                            $passaggio=$uno['Bisogno_passaggio'];


                            echo '<tr class="tr"><th class="thSI" style="border-top-left-radius: 10px;">Nome e cognome</th><th class="thSI">Allergie</th><th class="thSI">Automunito</th></tr>
                            <tr class="tr"><td class="tdSingoloUtente">'.$nome_cognome.'</td><td class="tdSingoloUtente">'.$esAlim.'</td class="tdSingoloUtente"><td class="tdSingoloUtente">'.$passaggio.'</td></tr>
                        ';
                   
                        ?>
            </table>

            <div class="distanzaMedia" style="padding:5%;">        

                <button type="submit" onclick="conferma('.popUp3');" class="btn btn-secondary">Annulla Partecipazione</button>

                <button type="button" onclick="conferma('.popUp1');" class="btn btn-secondary" >
                    <div class="colonne"> Cancella
                        <img width="22" height="22" src="immagini\icone\cestinoAperto.png" class="binUno"  alt="filled-trash"/>
                        <img width="22" height="22" src="immagini\icone\cestinoChiuso.png"class="binDue"  alt="filled-trash"/>
                    </div>
                </button>
             </div>

                

           
        </div>

        <form action="specifica.php" method="POST">
        <input type="hidden" name="idSpecifico" />

            <div class="popUp3"> <p>Annulla la partecipazione</br>
                <div class="distanzaMedia" style="padding-top:5%;margin-left:15%">        
                <button type="button" onclick="popUpNascosto()" class="btn btn-secondary"> Torna Indietro </button> 
                <button type="submit" name="annullaPart" class="btn btn-secondary"> Sì </button> </p> 
                </div>    
            </div>
        </form>

        <form action="specifica.php" method="POST">

            <div class="popUp1"> <p>conferma la cancellazione</br>
                <input type="hidden" name="idSpecifico" />
                <div class="distanzaMedia" style="padding-top:5%;margin-left:15%">        
                <button type="button" onclick="popUpNascosto()" class="btn btn-secondary"> annulla </button> 
                <button type="submit" name="cancella" class="btn btn-secondary"> Cancella </button> </p> 
                </div>    
            </div>
        </form>
        
    </body>

    <script src="js/gestione.js"></script>

</html>