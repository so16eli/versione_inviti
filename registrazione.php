<?php
session_start();

require 'C:\xampp\htdocs\apprendimento\Versione_GitHub\versione_inviti\config\config.php';
require 'C:\xampp\htdocs\apprendimento\Versione_GitHub\versione_inviti\config\amministratori.php';



//creo una connessione al dbms
$dab = new Database();
$connessione = $dab->getConnection();


$amministratore=new Amministratore($connessione);


if(isset($_POST['registrazione'])){
    $letNome = addslashes($_POST['nome']);
    $letEmail = addslashes($_POST['mail']);
    $letPsw = addslashes($_POST['psw']);

    $letPsw = password_hash($letPsw, PASSWORD_DEFAULT);

    $amministratore -> nome = $letNome;
    $amministratore -> email = $letEmail;
    $amministratore -> psw = $letPsw;

    $crazioneUtente = $amministratore -> createAdmin();

       
    if($crazioneUtente === true){
            echo "utente realizzato con successo";
            
            
           $headers = "From: weddinginfomattemarty";
           $to = "elisa.sorri99@gmail.com";
           mail($to, 'nuova registrazione','nuovo utente correttamente registrato', $headers);    
           
            
            ?>  
                <script>

                    setTimeout(function () {
                        window.location.href= 'login.php';
                    },2000);

                </script>

            <?php
            exit;
    }
    else {
        echo "Creazione utente non riuscita";
        $headers = "From: weddinginfomattemarty";
        $toErrore = "elisa.sorri99@gmail.com";
        mail($toErrore, 'Qualcosa è andato storto con la registrazione','errore presente con la registrazione: '.$crazioneUtente, $headers);
    }
}


?>

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
        <div class="container-fluid"> 
            
            <div class = "row g-0 justify-content-around">

                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 rimozMargini">
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">

                    <div class="sottotitolo4">
                        <h2>Registrazione</h2>
                    </div>

                    <form action="registrazione.php" method="POST">   
                        <div class = "form formLogin">

                            <label for="Nome">username di coppia: (in tal modo lo ricorderete entrambi)</label>
                            <input class="form-input" type="text" name="nome" placeholder="Inserire uno username da piccioncini" id="typeEmailX-2" class="form-control"/> 
                            
                            <label for="mail">mail: (servirà per ricevere info sui partecipanti)</label>
                            <input class="form-input" type="text" name="mail" placeholder="Inserire  qui mail" id="typeEmailX" class="form-control"/> 

                            <label for="Password">Ideare una passLove:</label>
                            <input class="form-input" type="text" name="psw" placeholder="Inserire password" id="typePasswordX-2" class="form-control"/>

                             <div class="bottone lunghezza2">
                                <button class="form-input btnIniziale biancoVero contorno specLog" type="submit" name="registrazione"> Registrazione </button>
                             </div>
                        </div>
                    </form> 
                </div>
            </div>

        </div>

    </body>

    <script src="js/javascript.js"></script>
</html>
