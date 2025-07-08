<?php 
require '/membri/weddinginfomattemarty/config/config.php';
require '/membri/weddinginfomattemarty/config/partecipanti.php';

session_start();

$dab= new Database();
$connessione= $dab -> getConnection();

$insPartecipazione=new Partecipanti($connessione);

if(isset($_POST['partecipazione'])){
$nome= $_POST['nome'];
$alimentazione= $_POST['alimentazione'];
$passaggio= $_POST['passaggio'];

$data= $_POST["dataTime"];
$partecipazione = "Si";
//print_r($passaggio);
$totaleNomi = count($nome);
$eta= $_POST['eta'];

}

?>
<html>
    <head>
        <link rel="stylesheet" href="css/stile.css">
    
    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@400;700&display=swap" rel="stylesheet">    </head>

    <body>
            <div class="header2">

            <div class="partecipaPart" style="position: absolute; visibility: hidden; z-index:2;">
                    <div id="sigilloCera" style="top:40%; left: 35%; max-width: 30%;">
                    <img src="immagini/icone/sigilloCeraConbordi.png"></div>
                    
                    <div class="bustaChiusa" style="position: absolute; height:100%;"> 
                    <img id="francobollo" src="immagini/francobollo.png"> 
                    </div>
            </div>
            </div>


            <div class="headerEstPartecipa2">
                <img src="immagini/fotoRicordo/10N.jpeg"> 
            </div>
            
            <div class="fogliaSinistraSei"> <img src="immagini/foglie.png"> </div>
     
            <div class="colonneNuove">

                <div class="blocco2 spazioRistretto" id="appare">

                    <img width="24" height="24" class= "arrowSpecifica" onclick="history.back();" src="https://img.icons8.com/material-rounded/24/828340/arrow-pointing-left.png" alt="arrow-pointing-left"/>        
                        
                        <div class="secondo" >
                            <img src="immagini/albero2.png">
                        </div>
                        
                    <?php
                        if(!isset($_SESSION['evitareRicarica'])){
                            $evitRicarica = 0;
                        }   else{
                            $evitRicarica = $_SESSION['evitareRicarica'];
                        }
                        
                        if(!isset($_SESSION['ricaricaPaginaPrincipale'])){
                        $_SESSION['ricaricaPaginaPrincipale'] = 1;
                        }

                        
                        if($evitRicarica==0){ 

                                $totale= [];

                                for($i=0; $i<$totaleNomi; $i++){
                                    $nomePulito = strip_tags(ucwords($nome[$i]));
                                    $alimentazionePulito = strip_tags(ucfirst($alimentazione['insieme'.$i]));
									$eta[$i] = !empty($eta[$i]) ? $eta[$i] : null;
                                    
                                    $insPartecipazione -> nomeECognome = $nomePulito;
                                    $insPartecipazione -> partecipa = $partecipazione;
                                    $insPartecipazione -> alimentazione = $alimentazionePulito;
                                    $insPartecipazione -> bisognoPassaggio = $passaggio['group'.$i];
                                    $insPartecipazione -> dataCompilazione = $data;
                                    $insPartecipazione -> eta = $eta[$i];


                                        $inserimento = $insPartecipazione -> inserisci();
                                            //echo "Data compilazione:". $data;
                                           // $nomeM =ucwords($nome[$i]);
                                           // $alimentazioneM =ucfirst($alimentazione['insieme'.$i]);

                                         

                                 		$recap = [$nomePulito, $alimentazionePulito, $passaggio['group'.$i], $eta[$i]];

                                        array_push($totale, $recap);

                                        
            
                            }
                            
                            if($inserimento === true){
                                      		echo "<p> inserimento Riuscito </p> ";
                                        	$headers = "From: weddinginfomattemarty";
                                            $to = "martuzzetta91@gmail.com";
                                            mail($to, 'Parteciperà anche: '.$nomePulito,'è stata inserita una nuova persona: '.$nomePulito, $headers);

                                        }
                                        else{
                                            echo "<p> qualcosa è andato storto, ti preghiamo di riprovare </p>";
                                            $toDue = "elisa.sorri99@gmail.com, martuzzetta91@gmail.com";
                                            $headers = "From: weddinginfomattemarty";
                                            mail($toDue, 'Qualcosa è andato storto con la partecipazione di utente'.$nomePulito,'errore presente: ' . $inserimento, $headers);

                                        } 

                           /* if($insPartecipazione){
                                echo "<p> inserimento Riuscito </p> ";
                            }
                            
                            else{
                                echo "<p> qualcosa è andato storto, ti preghiamo di riprovare </p>";
                            } */

                            $_SESSION['RECAPDATI'] = $totale;

                            $evitRicarica++;
                            $_SESSION['evitareRicarica'] = $evitRicarica;
                        } ?>

                        <h2>ecco fatto, grazie! <br>ti aspettiamo al nostro matrimonio!</h2>
                        
                        <div class="racconto">
                            <div class="colonneNuove">
                                <div class="infoUno">
                                    <div class="cerchioDue">
                                        <img src="immagini/icone/chiesa.png">
                                    </div>
                                    <p class="paragrafoInfoDue">
                                    
                                    <!--https://img.icons8.com/material-rounded/24/707137/calendar--v1.png-->

                                    Dettagli cerimonia:<br> 13 settembre 2025  alle ore 10:00, <br>Chiesa Parrocchiale di San Giovanni Bosco, 
                                    <a href="https://maps.app.goo.gl/VCypUNnDydkkfMr19" class="linkPosizione" target="_blank"><br> via Paolo Sarpi 117,</a> Torino (TO) </p>
                                    
                                </div>
                                
                                <div class="infoDue">
                                    <div class="cerchioDue" >
                                        <img src="immagini/icone/ristorante.png">
                                    </div>
                                    <p class="paragrafoInfoDue"> Dettagli pranzo: Cascina Granello di Senape,<br> ore 12:00,<br>
                                    <a href="https://maps.app.goo.gl/KMGiRhtUqr84iGiE6" class="linkPosizione" target="_blank">Str.S.Bernardo Fontanette 1/B </a>, <br>
                                        Frossasco (TO)</p>
                                </div>
                            </div>
                        </div>
                </div> 
                
                

               

                <div class="recap" >

                        
                        <h2>I dati che hai inserito:</h2>
                        <div class="fogliaSinistraCinque"> <img src="immagini/foglia.png"> </div>
                        <div class="fogliaDestraCinque"> <img src="immagini/foglia.png"> </div>
                        <div class="fogliaDestraQuattro" > <img src="immagini/foglia.png"> </div>

                        <?php
                        
                        
                        for($i=0; $i<$totaleNomi; $i++){
                            $nomeMAIUSC = strip_tags(ucwords($nome[$i]));
                            $alimentazioneMAIUSC = strip_tags(ucfirst($alimentazione['insieme'.$i]));


                            echo "<div ><p class='singolo_recap'> Nome e cognome: " . $nomeMAIUSC . "<br/>";
                            if($alimentazioneMAIUSC != "Null"){
                            echo "Esigenze alimentari: " . $alimentazioneMAIUSC . "<br/>";
                            }
                            echo " Necessità passaggio: " . $passaggio['group'.$i];
                             $etaSp = $eta[$i];
                            if($etaSp != ""){
                            echo "<br> Età minori: " . $etaSp . "<br>";
                            }
                              echo "</p> </div>";

                        }


                        ?>  
                        
                        <!--<div class="bottone"> <button class="form-inputDue">  <a href="creazionePdf.php">stampa recap</a></button> </div> -->

                        <div id="ringraziamenti"> Grazie,<br> Matteo e Marty</div>

                </div>

                <img src="immagini/fotoRicordo/9N.jpeg" class="fotoPartecipa"> 


            </div>            
       


        
            
        

    </body>

    <script src="js/javascriptPartecipa.js"></script>
    <script src="js/javascript.js"></script>

    <script>cadutaFoglie(4,300);
    </script>


</html>

