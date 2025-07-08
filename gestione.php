<?php
    session_start();

    require 'C:\xampp\htdocs\apprendimento\Versione_GitHub\versione_inviti\config\config.php';
    require 'C:\xampp\htdocs\apprendimento\Versione_GitHub\versione_inviti\config\partecipanti.php';
    require 'C:\xampp\htdocs\apprendimento\Versione_GitHub\versione_inviti\config\totalePartecipanti.php';
    require 'C:\xampp\htdocs\apprendimento\Versione_GitHub\versione_inviti\config\funzioni_specifiche\funzioni_non_partecipanti.php';


     
    if(!($_SESSION['id'])){
        session_destroy();
        header("Location: login.php");

    }

    $timeout_duration = 900;
    
    if(isset($_SESSION['ultimaAttivita'])&& (time()- $_SESSION['ultimaAttivita'] > $timeout_duration)){
        session_destroy();
        session_unset();
        header("Location: login.php");
        exit();
    }
    $_SESSION['ultimaAttivita'] = time();


    
    $dab= new Database();
    $connessione= $dab -> getConnection();

    $vistaPartecipazione=new Partecipanti($connessione);
    
    $part= $vistaPartecipazione -> elenco();
    $partecipanti = $part->fetchAll();


    $totPartecipanti=new totalePartecipanti($connessione);
/*
if(isset($_SESSION['np'])){
    $np=$_SESSION['np'];

    if($np>0) {  */

    //PARTE EFFETTIVAMENTE COMMENTATA DI BOZZA
    /* $nuovi = $totPartecipanti -> visTotalePartecipanti();
    $ultimiDue = $nuovi -> fetch(PDO::FETCH_NUM);  //somma di ieri e di oggi

    $ultimoAccesso = $totPartecipanti -> ultimo();
    $novitaUltimo = $ultimoAccesso -> fetch(PDO::FETCH_NUM); //solo il valore di oggi

    $nuoviPartecipanti= ($novitaUltimo[0]*2)-$ultimiDue[0]; //(valore di ieri e di oggi)-valore di oggix2
    $np = $nuoviPartecipanti; */
    //echo $np;
    //    $np = $_SESSION['np'];

 
 
    /*  $primaRiga= $vistaPartecipazione -> selezionePrima($np);

    $riga = $primaRiga -> fetchAll();
    }
}  
else{ 
    header("Refresh:0");
} */

    /*$datatime = $_POST['timeLogin'];
    echo $datatime; */


   // $totPartecipanti -> dataLogin = $data;

    // $tot= $totPartecipanti -> inserisciPartData();

?>
<html>
    <html>
  <head>
    	<title> versioneProva </title>
            
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!--css-->
            <link rel="stylesheet" href="css/stilePresentazione.css">

            <!-- bootstrap-->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

            <!-- collegamente a jquery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
            <!-- collegamento a Google font e alcune tipologie di font-->
            <link rel="preconnect" href="https://fonts.googleapis.com"> 
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            
            <link href="https://fonts.googleapis.com/css2?family=Ruwudu:wght@400;500;600;700&family=Satisfy&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Marck+Script&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Croissant+One&display=swap" rel="stylesheet">


    </head>


    <body>
            
    <div class="gestione">
            <div class="vuoto"> </div>

            <div class="container-fluid"> 
                <div class="row justify-content-center">
                        <div class="col-9 col-md-9 col-lg-9 col-xl-8">
                            <div class="gestioneArea">
                                <h3 style="font-size:16px">PAGINA PER LA GESTIONE DEI PARTECIPANTI</h3>
                            </div>
                        </div>
                        <div class="col-2 col-md-1 col-lg-1 col-xl-2">
                            <a href="logout.php"><button type="button" class="btn btn-secondary">Logout </button></a>
                        </div>
                 </div>
             </div>

            <div class="container-fluid"> 
                <div class="row justify-content-center">
                    <div class="col-11 col-md-10 col-lg-10 col-xl-10">


                            <div class="gestioneArea">
                                <h3 style="font-size:16px">PAGINA PER LA GESTIONE DEI PARTECIPANTI</h3>
                            </div>

                            <div class="distanza">        
                                   <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="tabella-tab" data-bs-toggle="tab" data-bs-target="#tabella1" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tabella di Sintesi</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="partecipati-tab" data-bs-toggle="tab" data-bs-target="#partecipanti1" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Info partecipanti</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="nonPartecipanti-tab" data-bs-toggle="tab" data-bs-target="#nonPartecipanti1" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Non partecipanti</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="alimentazione-tab" data-bs-toggle="tab" data-bs-target="#alimentazione1" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Alimentazione</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="passaggio-tab" data-bs-toggle="tab" data-bs-target="#passaggio1" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Bisogno passaggio</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="eta-tab" data-bs-toggle="tab" data-bs-target="#eta1" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Minori</button>
                                        </li>
                                        
                                    </ul>
                                    
                                    <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tabella1" role="tabpanel" aria-labelledby="tabella-tab" tabindex="0">
                                        <div class="container sfondoTabella"> 
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-10 col-lg-10 col-xl-10">

                                                        <div id="vediTutto" >
                                                            <div class="TabellaPrincipale">
                                                            <h4> Pagina dedicata alla lista dei partecipanti </h4>


                                                                    <table class="table">
                                                                        <tr class="tr"><th class="th" id="thDevice">Partecipante</th><th class="th">Nome e cognome</th><th class="th">Esigenze alimentari</th><th class="th">Bisogno Passaggio</th><th class="th">Data</th><th class="th" id="thDevice">azione</th></tr>
                                                                        <?php
                                                                        $conteggio= 1;
                                                                                
                                                                        if(isset($_SESSION['np'])){
                                                                            $np=$_SESSION['np'];

                                                                            if($np>0) {
                                                                                $arrayVisti = [];
                                                                                $tabellaCompletaNuovi= [];


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

                                                                                    foreach($partecipanti as $row){

                                                                                        if (!in_array($row['Id'], $arrayVisti)) {
                                                                                            
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
                                                                                                

                                                                                                    $rigaTBCODue=[$conteggio, $nomeEcognome, $esAlimentari, $bisognoPassaggio, $dataComp];
                                                                                                    array_push($tabellaCompletaNuovi, $rigaTBCODue);
                                                                                                    $conteggio++;
                                                            
                                                                                                }
                                                                                                elseif($row['Partecipazione']="No"){
                                                                                                    $conteggio++;
                                                                                                }
                                                                                            }
                                                                                            
                                                                                            
                                                                                    }
                                                                                    $_SESSION['recapDatiTabellaCompleta'] =$tabellaCompletaNuovi;

                                                                            }

                                                                            
                                                                            else{
                                                                                $tabellaCompleta= [];

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
                                                            <div class="container-fluid"> 
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-5 col-md-5 col-lg-5 col-xl-5">
                                                                            <div class="bottone lunghezza2"> <button class="form-input btnIniziale biancoVero contorno specLog" >  <a href="creazionePdfTabella.php" style="text-decoration: none; color:inherit;">stampa recap</a></button> </div>
                                                                        </div>
                                                                    </div>
                                                            </div>

                                                            <?php                                                                  
                                                                        $conteggio= $conteggio-1;
                                                                        echo "<div class='gestioneArea'><h3 style='font-size:16px'>Numero totale inserimenti(partecipanti e non): ". $conteggio. "</h3></div>";
                                                                        $_SESSION['conteggioTotale']= $conteggio;
                                                            ?>
                                                        </div>


                                                </div> 
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="partecipanti1" role="tabpanel" aria-labelledby="partecipanti-tab" tabindex="0"> 
                                       
                                        <div class="container sfondoTabella"> 
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-10 col-lg-10 col-xl-10">
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
                                                                    echo "<div class='gestioneAreaNumeroParziale'>
                                                                                <h3 style='font-size:16px;'>Totale:". $conteggio1. "</h3>
                                                                        </div>";

                                                                    $_SESSION['conteggioTotaleNomeCognome'] =$conteggio1;
                                                                    ?>  

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class="tab-pane fade" id="nonPartecipanti1" role="tabpanel" aria-labelledby="nonPartecipanti-tab" tabindex="0">
                                         <div class="container sfondoTabella"> 
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-10 col-lg-10 col-xl-10">

                                            <div class="TabelleSecondarie" id="soloNonPartecipanti">
                                                <h4> Tabella dei non partecipanti</h4>

                                                <table class="table">
                                                                            <tr class="tr"><th class="th" style="border-top-left-radius: 20px; border-bottom-left-radius: 15px;">Partecipante</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Nome e cognome</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Partecipazione</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Messaggio</th></tr>

                                                            <?php
                                                            $conteggio2= 1;
                                                            $vistaNonPartecipazione=new nonPartecipanti($connessione);

                                                            $nonPart= $vistaNonPartecipazione -> selezioneMessaggi();
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
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="alimentazione1" role="tabpanel" aria-labelledby="alimentazione-tab" tabindex="0">
                                           <div class="container sfondoTabella"> 
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-10 col-lg-10 col-xl-10">
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
                                         </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="passaggio1" role="tabpanel" aria-labelledby="passaggio-tab" tabindex="0">
                                        <div class="container sfondoTabella"> 
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-10 col-lg-10 col-xl-10">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="eta1" role="tabpanel" aria-labelledby="eta-tab" tabindex="0">
                                        <div class="container sfondoTabella"> 
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-10 col-lg-10 col-xl-10">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                         </div>
                                <!-- 
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
                                        -->
                            
                            </div>
                    </div>
                            
                    
                </div>
            </div>    

    <!--<div class="container sfondoTabella"> 
        <div class="row justify-content-center">
            <div class="col-10 col-md-10 col-lg-10 col-xl-10">

                    <div id="vediTutto" >
                        <div class="TabellaPrincipale">
                        <h4> Pagina dedicata alla lista dei partecipanti </h4>


                                <table class="table">
                                    <tr class="tr"><th class="th" id="thDevice">Partecipante</th><th class="th">Nome e cognome</th><th class="th">Esigenze alimentari</th><th class="th">Bisogno Passaggio</th><th class="th">Data</th><th class="th" id="thDevice">azione</th></tr>
                                    <?php
                                    $conteggio= 1;
                                            
                                    if(isset($_SESSION['np'])){
                                        $np=$_SESSION['np'];

                                        if($np>0) {
                                            $arrayVisti = [];
                                            $tabellaCompletaNuovi= [];


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

                                                foreach($partecipanti as $row){

                                                    if (!in_array($row['Id'], $arrayVisti)) {
                                                        
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
                                                            

                                                                $rigaTBCODue=[$conteggio, $nomeEcognome, $esAlimentari, $bisognoPassaggio, $dataComp];
                                                                array_push($tabellaCompletaNuovi, $rigaTBCODue);
                                                                $conteggio++;
                        
                                                            }
                                                            elseif($row['Partecipazione']="No"){
                                                                $conteggio++;
                                                            }
                                                        }
                                                        
                                                        
                                                }
                                                $_SESSION['recapDatiTabellaCompleta'] =$tabellaCompletaNuovi;

                                        }

                                        
                                        else{
                                            $tabellaCompleta= [];

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
                        <div class="container-fluid"> 
                                <div class="row justify-content-center">
                                    <div class="col-5 col-md-5 col-lg-5 col-xl-5">
                                        <div class="bottone lunghezza2"> <button class="form-input btnIniziale biancoVero contorno specLog" >  <a href="creazionePdfTabella.php" style="text-decoration: none; color:inherit;">stampa recap</a></button> </div>
                                    </div>
                                </div>
                        </div>
                    </div>


            </div> 
        </div> 
    </div>                           
    COMMENTO TEMPORANEO PER SISTEMAZIONE GRAFICA
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
                    echo "<div class='gestioneAreaNumeroParziale'>
                                <h3 style='font-size:16px;'>Totale:". $conteggio1. "</h3>
                          </div>";

                    $_SESSION['conteggioTotaleNomeCognome'] =$conteggio1;
                    ?>  

    </div>

    
    
    <div class="TabelleSecondarie" id="soloNonPartecipanti">
        <h4> Tabella dei non partecipanti</h4>

        <table class="table">
                                       <tr class="tr"><th class="th" style="border-top-left-radius: 20px; border-bottom-left-radius: 15px;">Partecipante</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Nome e cognome</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Partecipazione</th><th class="th" style="border-top-right-radius: 20px; border-bottom-right-radius: 15px;">Messaggio</th></tr>

                    <?php
                    $conteggio2= 1;
                    $vistaNonPartecipazione=new nonPartecipanti($connessione);

                    $nonPart= $vistaNonPartecipazione -> selezioneMessaggi();
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
            -->


    <?php

        if(!isset($_SESSION['ripetizione'])){
            $ripetizione = 0;
        }
        else{
            $ripetizione = $_SESSION['ripetizione'];
        }

            $totPartecipanti -> totalePartecipanti = $conteggio;
        if($ripetizione==0){
                $totaleAttuale = $totPartecipanti -> inserisciPartData();

            //echo "conteggio attivato";
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

    <script src="Javascript/javascript.js"></script>
    <script src="Javascript/gestione.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</html>
