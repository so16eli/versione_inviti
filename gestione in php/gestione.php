<?php
    session_start();

    require '/membri/weddinginfomattemarty/config/config.php';
    require '/membri/weddinginfomattemarty/config/partecipanti.php';
    require '/membri/weddinginfomattemarty/config/totalePartecipanti.php';
    
    //FA IN MODO CHE TORNANDO INDIETRO DA LOGIN NON SI TORNI SULLA PAGINA GESTIONE
    //LA SESSION ID CONTROLLA IL LOGIN, SE ASSENTE DISTRUGGE SESSIONE E RIMANDA ALLA PAGINA LOGIN
    if(!($_SESSION['id'])){
        session_destroy();
        header("Location: login.php");

    }

    //DURATA SESSIONE, TEMPO TRASCORRIBILE DENTRO GESTIONE UNA VOLTA COMPIUTO LOGIN
    $timeout_duration = 900;
    
    //se la sessione presente sotto è stata inizializzata precedentemente e 
    // la differenza tra orario attuale e orario precedente è maggiore della variabile sopra 
    // chiude la sessione

    if(isset($_SESSION['ultimaAttivita'])&& (time()- $_SESSION['ultimaAttivita'] > $timeout_duration)){
        session_destroy();
        session_unset();
        header("Location: login.php");
        exit();
    }
//restituisce in una sessione la data e l'orario
    $_SESSION['ultimaAttivita'] = time();


    
    $dab= new Database();
    $connessione= $dab -> getConnection();

    $vistaPartecipazione=new Partecipanti($connessione);
    
    //RICHIAMA ELENCO PER LEGGERE PARTECIPANTI ORDINATI PER DATA
    $part= $vistaPartecipazione -> elenco();
    $partecipanti = $part->fetchAll();

    $totPartecipanti=new totalePartecipanti($connessione);


    // SE è SETTATA LA VARIABILE, SONO PRESENTI NUOVI PARTECIPANTI
if(isset($_SESSION['np'])){

    //INSERISCE LA SESSIONE IN NP
    $np=$_SESSION['np'];

    //controlla se sono presenti nuovi partecipanti
    if($np>0) {

            /* $nuovi = $totPartecipanti -> visTotalePartecipanti();
                $ultimiDue = $nuovi -> fetch(PDO::FETCH_NUM);  //somma di ieri e di oggi

                $ultimoAccesso = $totPartecipanti -> ultimo();
                $novitaUltimo = $ultimoAccesso -> fetch(PDO::FETCH_NUM); //solo il valore di oggi

                $nuoviPartecipanti= ($novitaUltimo[0]*2)-$ultimiDue[0]; //(valore di ieri e di oggi)-valore di oggix2
                $np = $nuoviPartecipanti; 
            */

    //seleziona i primi record sulla base del numero in np
    $primaRiga= $vistaPartecipazione -> selezionePrima($np);
    $riga = $primaRiga -> fetchAll();
    }
}
else{ 
    header("Refresh:0");
}
    /*$datatime = $_POST['timeLogin'];
    echo $datatime; */


   // $totPartecipanti -> dataLogin = $data;

    // $tot= $totPartecipanti -> inserisciPartData();

?>
<html>
    <head>
    	<title> weddinginfomattemarty </title>
    	<link rel="stylesheet" href="css/stile.css">
    
    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body>
            <div class="gestioneArea">
                <h3 style="font-size:16px">PAGINA PER LA GESTIONE DEI PARTECIPANTI</h3>
            </div>

        <div class="gestione">
            <div class="distanza">        
            
                <div class="dropdown" >
                    <a class="btn btn-success dropdown-toggle" role="button"  id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" onclick="vediTutto();">
                    Vedi tutto
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" onclick="sezione('#vediTutto','#soloPartecipanti');">Solo nome e cognome</a></li>
                        <li><a class="dropdown-item" onclick="sezione('#vediTutto','#soloNonPartecipanti');">Non partecipanti</a></li>
                        <li><a class="dropdown-item" onclick="sezione('#vediTutto','#NCEaAlim');" >Esigenze alimentari</a></li>
                        <li><a class="dropdown-item" onclick="sezione('#vediTutto','#bisognoPassaggio');" >Necessità passaggio</a></li>
                   		<li><a class="dropdown-item" onclick="sezione('#vediTutto','#eta');">Età</a></li>

                   	</ul>
                    <div id="tornaIndietro"><button type="button" class="btn btn-success" onclick="vediTutto();">Torna alla tabella completa</button></div>

                </div>



                    <a href="logout.php"><button type="button" class="btn btn-secondary">Logout </button></a>

            </div>



    <div id="vediTutto" >
        <div class="TabellaPrincipale">
        <h4> Pagina dedicata alla lista dei partecipanti </h4>

               <!-- PRIMA TABELLA CON TUTTI I RECORD -->
                <table class="table">
                    <tr class="tr"><th class="th" id="thDevice" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;">Partecipante</th><th class="th">Nome e cognome</th><th class="th">Esigenze alimentari</th><th class="th">Bisogno Passaggio</th><th class="th">Data</th><th class="th" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px; " id="thDevice">azione</th></tr>
                    <?php
                    // ogni tabella conta i record con una variabile conteggio
                    $conteggio= 1;
                            
                    //controlla presenza di nuovi partecipanti e li affida a np e controlla il numero
                    //sia più grande di 0
                    if(isset($_SESSION['np'])){
                        $np=$_SESSION['np'];

                        if($np>0) {

                            //Riempie di volta in volta un array con i nuovi per stampare il recap
                            $arrayVisti = [];
                            $tabellaCompletaNuovi= [];

                                //selezione ultimi, nuovi, record da tabella, riga definita in 66
                                foreach($riga as $prime){
									
                                    if($prime['Partecipazione']!="No"){

                                    echo '<tr class="tr" id="primaRiga" style="background-color:#befeb1; border-bottom: 5px solid rgb(205, 255, 195);">
                                    <td class="td">'.$conteggio.'<span style="margin-left:3%; color:rgb(247, 28, 28); font-weight: 700;">NEW!</span></td>
                                    
                                    <td class="td">'.$prime['Nome_cognome'].'</td>
                                    <td class="td">'.$prime['Esigenze_alimentari'].'</td class="td"><td class="td">'.$prime['Bisogno_passaggio'].'</td></td class="td"><td class="td">'.substr($prime['Data_compilazione'], 0, 10).'</td>
                                    <td class="td"><a href="specifica.php?id='.$prime['Id'].'"><img width="19" height="25" src="immagini\icone\lente.png"  alt="search--v1" class="binDue"/><img width="25" height="25" src="https://img.icons8.com/ios/50/4D4D4D/search--v1.png" alt="search--v1"  class="binUno" "/></a> </td></tr>'; 
                                        
                                        $arrayVisti[] = $prime['Id'];
                                        $rigaTBCOUno=[$conteggio, $prime['Nome_cognome'], $prime['Esigenze_alimentari'], $prime['Bisogno_passaggio'], substr($prime['Data_compilazione'], 0, 10)];
                                        array_push($tabellaCompletaNuovi, $rigaTBCOUno);
                                        $conteggio++;
                                    }
                                }
                        
                                $arrayVisti= array_reverse($arrayVisti); 
                                
                                //SEGUE IL RESTO DEI RECORD CHE DEVONO ESSERE PRESENTI NELLA TABELLA DOPO I NUOVI
                                foreach($partecipanti as $row){
                                    
                                    //controlla che non siano nuovi, ossia che non siano nell'array dei nuovi
                                    if (!in_array($row['Id'], $arrayVisti)) {
                                        
                                        //controllo che siano partecipanti
                                        if($row['Partecipazione']!="No"){

                                            $nomeEcognome= $row['Nome_cognome'];
                                            $partecConf= $row['Partecipazione'];
                                            $esAlimentari= $row['Esigenze_alimentari'];
                                            $bisognoPassaggio= $row['Bisogno_passaggio'];
                                            $dataComp= substr($row['Data_compilazione'], 0, 10);
                        
                                            echo '<tr class="tr">
                                            <td class="td">'.$conteggio.'</td>
                                            <td class="td">'.$nomeEcognome.'</td><td class="td">'.$esAlimentari.'</td class="td"><td class="td">'.$bisognoPassaggio.'</td><td class="td">'.$dataComp.'</td>
                                            <td class="td"><a href="specifica.php?id='.$row['Id'].'"><img width="19" height="25" src="immagini\icone\lente.png"  alt="search--v1" class="binDue"/><img width="25" height="25" src="https://img.icons8.com/ios/50/4D4D4D/search--v1.png" alt="search--v1"  class="binUno" "/></a></td></tr>';
                                               
                                                //aggiunge il resto dei partecipanti all'array con i nuovi
                                                $rigaTBCODue=[$conteggio, $nomeEcognome, $esAlimentari, $bisognoPassaggio, $dataComp];
                                                array_push($tabellaCompletaNuovi, $rigaTBCODue);
                                                //aumenta il conto
                                                 $conteggio++;
        
                                            }
                                            //nei casi in cui dei non partecipanti non li lista ma li inserisce nel conteggio
                                            elseif($row['Partecipazione']="No"){
                                                $conteggio++;
                                            }
                                        }
                                        
                                        
                                }
                                $_SESSION['recapDatiTabellaCompleta'] =$tabellaCompletaNuovi;

                        }
                        //QUI SI CONCLUDE IL CASO IN CUI CI SIANO NUOVI PARTECIPANTI

                        //IN QUESTO CASO CONSIDERA IL CASO IN CUI LA VARIABILE DEI NUOVI PARTECIPANTI è A ZERO, NON SONO RILEVATI NUOVI PARTECIPANTI
                        else{
                            $tabellaCompleta= [];
                            
                            //non essendoci nuovi partecipanti parte a elencare direttamente partecipanti
                            foreach($partecipanti as $row){
                                
                                if($row['Partecipazione']!="No"){
                            
                                    $nomeEcognome= $row['Nome_cognome'];
                                    $partecConf= $row['Partecipazione'];
                                    $esAlimentari= $row['Esigenze_alimentari'];
                                    $bisognoPassaggio= $row['Bisogno_passaggio'];
                                    $dataComp= substr($row['Data_compilazione'], 0, 10);
                        
                                    echo '<tr class="tr">
                                    <td class="td tdDevice">'.$conteggio.'</td>
                                    <td class="td">'.$nomeEcognome.'</td><td class="td">'.$esAlimentari.'</td><td class="td">'.$bisognoPassaggio.'</td><td class="td">'.$dataComp.'</td><td class="td"><a href="specifica.php?id='.$row['Id'].'"><img width="19" height="25" src="immagini\icone\lente.png"  alt="search--v1" class="binDue"/><img width="25" height="25" src="https://img.icons8.com/ios/50/4D4D4D/search--v1.png" alt="search--v1"  class="binUno" "/>
                                    
                                        </a></td></tr>';
                                        $rigaTBCO=[$conteggio, $nomeEcognome, $esAlimentari, $bisognoPassaggio, $dataComp];
                                        array_push($tabellaCompleta, $rigaTBCO); 
                                        $conteggio++;
   
                                }
                                elseif ($row['Partecipazione']="No"){
                                    $conteggio++;
                                }
                            }
                            $_SESSION['recapDatiTabellaCompleta'] =$tabellaCompleta;
                        }
                    }
                        else{
                            $tabellaCompletaEcc= [];

                            foreach($partecipanti as $row){
                                
                                if($row['Partecipazione']!="No"){

                                $nomeEcognome= $row['Nome_cognome'];
                                $partecConf= $row['Partecipazione'];
                                $esAlimentari= $row['Esigenze_alimentari'];
                                $bisognoPassaggio= $row['Bisogno_passaggio'];
                                $dataComp= substr($row['Data_compilazione'],0, 10);

                                echo '<tr class="tr">
                                <td class="td">'.$conteggio.'</td>
                                <td class="td">'.$nomeEcognome.'</td><td class="td">'.$esAlimentari.'</td class="td"><td class="td">'.$bisognoPassaggio.'</td><td class="td">'.$dataComp.'</td><td class="td"><a href="specifica.php?id='.$row['Id'].'"><img width="19" height="25" src="immagini\icone\lente.png"  alt="search--v1" class="binDue"/><img width="25" height="25" src="https://img.icons8.com/ios/50/4D4D4D/search--v1.png" alt="search--v1"  class="binUno" "/></a></td></tr>';
                                    $rigaTBCOEcc=[$conteggio, $nomeEcognome, $esAlimentari, $bisognoPassaggio, $dataComp];
                                    array_push($tabellaCompletaEcc, $rigaTBCOEcc); 

                                    $conteggio++;
                                
                                }   
                                elseif($row['Partecipazione']="No"){
                                    $conteggio++;
                                }
                            }
                            $_SESSION['recapDatiTabellaCompleta'] =$tabellaCompletaEcc;

                        }
                
                    ?>
                </table>
                </div>
                <?php

                    $dataAttuale= date("d/m/y");
                    $_SESSION['dataAttuale'] = $dataAttuale;
                ?>
                <div class="bottone"> <button class="form-inputDue" >  <a href="creazionePdfTabella.php" style="text-decoration: none;color: white;">stampa recap</a></button> </div>

    </div>

    <div class="TabelleSecondarie" id="soloPartecipanti">
        <h4> partecipanti</h4>

            <table class="table">
                    <tr class="tr"><th class="th" style="border-top-left-radius: 20px; border-bottom-left-radius: 15px;">Partecipante</th><th class="th" style="border-top-right-radius: 20px;border-bottom-right-radius: 15px;">Nome e cognome</th></tr>

            <?php
            $conteggio1= 1;
            $tabellaconSoloNomeCognome= [];
            foreach($partecipanti as $row){
                if($row['Partecipazione']!="No"){


                        $nomeEcognome= $row['Nome_cognome'];
                        $partecConf= $row['Partecipazione'];
                        $esAlimentari= $row['Esigenze_alimentari'];
                        $bisognoPassaggio= $row['Bisogno_passaggio'];
                        $dataComp= $row['Data_compilazione'];
    
                        
                        ?>

                <?php
                    echo '<tr class="tr">
                        <td class="td">'.$conteggio1.'</td>
                        <td class="td">'.$nomeEcognome.'</td></tr>';
                        $righeSoloNome =[$conteggio1, $nomeEcognome];
                        array_push($tabellaconSoloNomeCognome,$righeSoloNome);
                        $conteggio1++;  
                ?>
            
            <?php
                        }
                    }   //chiusura del foreach che contiene le righe delle alternative a Vedi 'Tutto'
                $_SESSION['recapDatiTabellaSoloNominativo'] =$tabellaconSoloNomeCognome;

           ?>
            </table>
            <div class="bottone"> <button class="form-inputDue" >  <a href="creazionePdfTabPartecipanti.php" style="text-decoration: none;color: white;">stampa recap di questa tabella</a></button> </div>

                    <?php 
                    $conteggio1=$conteggio1-1;
                    echo "<div class='gestioneAreaNumeroParziale'><h3 style='font-size:16px;'>Totale:". $conteggio1. "</h3></div>"; 
                    $_SESSION['conteggioTotaleNomeCognome'] =$conteggio1;
                    ?>

    </div>

    
    
    <div class="TabelleSecondarie" id="soloNonPartecipanti">
        <h4> Tabella dei non partecipanti</h4>

        <table class="table">
                                       <tr class="tr"><th class="th" style="border-top-left-radius: 20px; border-bottom-left-radius: 15px;">Partecipante</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Nome e cognome</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Partecipazione</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Messaggio</th></tr>

                    <?php
                    $conteggio2= 1;
                    $nonPart= $vistaPartecipazione -> selezioneMessaggi();
                    $nonPartecipanti = $nonPart->fetchAll();

                    foreach($nonPartecipanti as $nonPa){
                        
                                $nomeEcognome= $nonPa['Nome_cognome'];
                                $partecConf= $nonPa['Partecipazione'];
                                $messaggio= $nonPa['Messaggio'];

                                ?>

                        <?php
                            echo '<tr class="tr">
                                <td class="td">'.$conteggio2.'</td>
                                <td class="td">'.$nomeEcognome.'</td>
                                <td class="td">'.$partecConf.'</td>
                                <td class="td">'.$messaggio.'</td></tr>';
                                $conteggio2++;          
                        ?>
                    
            <?php
                    }   //chiusura del foreach che contiene le righe delle alternative a Vedi 'Tutto'
            ?>
        </table>
            <?php 
            $conteggio2=$conteggio2-1;
            echo "<div class='gestioneAreaNumeroParziale'><h3 style='font-size:16px;'>Totale:". $conteggio2. "</h3></div>";
            ?>

    </div>

            
    
    <div  class="TabelleSecondarie" id="NCEaAlim" >
        <h4> Tabella con chi ha allergie e altre esigenze alimentari </h4>

        <table class="table">
                    <tr class="tr">
                    <th class="th" style="border-top-left-radius: 20px; border-bottom-left-radius: 15px;">Nome e cognome</th>
                    <th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Esigenza alimentare</th></tr>

                        <?php
                        $conteggio3= 1;
                        $tabellaAlim= [];

                        foreach($partecipanti as $row){
                            if($row['Partecipazione']!="No"){
                                if($row['Esigenze_alimentari']!="Null"){


                                    $nomeEcognome= $row['Nome_cognome'];
                                    $partecConf= $row['Partecipazione'];
                                    $esAlimentari= $row['Esigenze_alimentari'];
                                    $dataComp= $row['Data_compilazione'];
                
                                    
                                    ?>

                            <?php
                                echo '<tr class="tr">
                                    <td class="td">'.$nomeEcognome.'</td>
                                    <td class="td">'.$esAlimentari.'</td></tr>';
                                    $righeAlim =[$nomeEcognome, $esAlimentari];
                                    array_push($tabellaAlim,$righeAlim);
            
                                    $conteggio3++;          
                            ?>
                        
                        <?php
                        }
                    }
                }   //chiusura del foreach che contiene le righe delle alternative a Vedi 'Tutto'
                $_SESSION['recapDatiTabellaAlimentazione'] =$tabellaAlim;

               ?>
        </table>
        <div class="bottone"> <button class="form-inputDue" >  <a href="creazionePdfTabEsigenze.php" style="text-decoration: none;color: white;">stampa recap di questa tabella</a></button> </div>

        <?php 
        $conteggio3=$conteggio3-1;
        echo "<div class='gestioneAreaNumeroParziale'><h3 style='font-size:16px;'>Totale:". $conteggio3. "</h3></div>"; 
        $_SESSION['conteggioTotaleEsigenze'] =$conteggio3;
        ?>

    </div>

    
    
    <div class="TabelleSecondarie" id="bisognoPassaggio">
        <h4> Tabella con le persone che hanno bisogno di un passaggio</h4>

        <table class="table">
                    <tr class="tr"><th class="th" style="border-top-left-radius: 20px; border-bottom-left-radius: 15px;">Nome e cognome</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Bisogno passaggio </th></tr>

                        <?php
                        $conteggio4= 1;
                        $tabellaPassaggi= [];

                        foreach($partecipanti as $row){
                            if($row['Partecipazione']!="No"){
                                if($row['Bisogno_passaggio']!="No"){


                                    $nomeEcognome= $row['Nome_cognome'];
                                    $partecConf= $row['Partecipazione'];
                                    $bisognoPassaggio= $row['Bisogno_passaggio'];                                    
                                    ?>

                            <?php
                                echo '<tr class="tr">
                                    <td class="td">'.$nomeEcognome.'</td>
                                    <td class="td">'.$bisognoPassaggio.'</td></tr>';
                                    $righePassaggio =[$nomeEcognome, $bisognoPassaggio];
                                    array_push($tabellaPassaggi,$righePassaggio);

                                    $conteggio4++;          
                            ?>
                        
                    <?php
                        }
                    }
                }   //chiusura del foreach che contiene le righe delle alternative a Vedi 'Tutto'
                $_SESSION['recapDatiTabellaPassaggi'] =$tabellaPassaggi;

                ?>
        </table>
        <div class="bottone"> <button class="form-inputDue" >  <a href="creazionePdfTabPassaggio.php" style="text-decoration: none;color: white;">stampa recap di questa tabella</a></button> </div>

                <?php
                $conteggio4 = $conteggio4-1;
                echo "<div class='gestioneAreaNumeroParziale'><h3 style='font-size:16px;'>Totale:". $conteggio4. "</h3></div>";

                $_SESSION['conteggioTotalePassaggi'] =$conteggio4;

                ?>
    </div>
    
    <div class="TabelleSecondarie" id="eta">
        <h4> Tabella con le persone di età inferiore ai 10 anni</h4>

        <table class="table">
                    <tr class="tr"><th class="th" style="border-top-left-radius: 20px; border-bottom-left-radius: 15px;">Nome e cognome</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Età</th></tr>

                        <?php
                        $conteggio5= 1;
                        $tabellaEta= [];

                        foreach($partecipanti as $row){
                            if($row['Partecipazione']!="No"){
                                if($row['Eta_minori']!=""){


                                    $nomeEcognome= $row['Nome_cognome'];
                                    $eta= $row['Eta_minori'];                                    
                                    ?>

                            <?php
                                echo '<tr class="tr">
                                    <td class="td">'.$nomeEcognome.'</td>
                                    <td class="td">'.$eta.'</td></tr>';
                                    $righeEta =[$nomeEcognome, $eta];
                                    array_push($tabellaEta,$righeEta);

                                    $conteggio5++;          
                            ?>
                        
                    <?php
                        }
                    }
                }   //chiusura del foreach che contiene le righe delle alternative a Vedi 'Tutto'
                $_SESSION['recapDatiTabellaEta'] =$tabellaEta;

                ?>
        </table>
        <div class="bottone"> <button class="form-inputDue" >  <a href="creazionePdfTabEta.php" style="text-decoration: none;color: white;">stampa recap di questa tabella</a></button> </div>

                <?php
                $conteggio5 = $conteggio5-1;
                echo "<div class='gestioneAreaNumeroParziale'><h3 style='font-size:16px;'>Totale:". $conteggio5. "</h3></div>";

                $_SESSION['conteggioTotaleEta'] =$conteggio5;

                ?>
    </div>



    <?php

    $conteggio= $conteggio-1;
         echo "<div class='gestioneArea'><h3 style='font-size:16px'>Numero totale inserimenti(partecipanti e non): ". $conteggio. "</h3></div>";
         $_SESSION['conteggioTotale']= $conteggio;
        if(!isset($_SESSION['ripetizione'])){
        $ripetizione = 0;
        }
        else{
        $ripetizione = $_SESSION['ripetizione'];
        }

    $totPartecipanti -> totalePartecipanti = $conteggio;
    if($ripetizione==0){
        $totaleAttuale = $totPartecipanti -> inserisciPartData();

            echo "conteggio attivato";
            $ripetizione++;
            $_SESSION['ripetizione'] = $ripetizione;
        
    } 

    $nuovi = $totPartecipanti -> visTotalePartecipanti();
    $ultimiDue = $nuovi -> fetch(PDO::FETCH_NUM);  //somma di ieri e di oggi

    $ultimoAccesso = $totPartecipanti -> ultimo();
    $novitaUltimo = $ultimoAccesso -> fetch(PDO::FETCH_NUM); //solo il valore di oggi

    $nuoviPartecipanti= ($novitaUltimo[0]*2)-$ultimiDue[0]; //(valore di ieri e di oggi)-valore di oggix2
    $np = $nuoviPartecipanti;
    $_SESSION['np'] = $np;

    ?> 
              <!--  <table class="table">
                <tr class="tr"><th class="th" style="border-top-left-radius: 10px;">Partecipante</th><th class="th" style="border-top-left-radius: 10px;">Nome e cognome</th><th class="th">Esigenze alimentari</th><th class="th">Bisogno Passaggio</th><th class="th" style="border-top-right-radius: 10px;">Data</th><th class="th" style="border-top-right-radius: 10px;">azione</th></tr> -->

        </div>

    </body>

    <script src="js/javascript.js"></script>
    <script src="js/gestione.js"></script>

</html>
