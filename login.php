<?php
session_start();

require 'C:\xampp\htdocs\apprendimento\Versione_GitHub\versione_inviti\config\config.php';
require 'C:\xampp\htdocs\apprendimento\Versione_GitHub\versione_inviti\config\amministratori.php';

//creo una connessione al dbms
$dab = new Database();
$connessione = $dab->getConnection();


$amministratoreLG=new Amministratore($connessione);

if(isset($_POST['login'])){
    $letturaNome= trim($_POST['nome']);
    $letturaPsw= $_POST['psw'];

    $stmt= $amministratoreLG -> read();
    $principale= $stmt -> fetchAll();

    foreach($principale as $value){
        $pswSpecifica = $value['psw'];

        if(password_verify($letturaPsw, $pswSpecifica) && $letturaNome==trim($value['nome'])) {
            $_SESSION["id"]=$value["id"];
            $_SESSION["nome"]=$value["nome"];

            header("location: gestione.php");
            break;
    }
    else {
        echo "login non riuscito";
        
    } 
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
                            <h2> La Nostra Area Riservata </h2>
                        </div>
                
                    <form action="login.php" method="POST">   

                        <div class="form formLogin">

                            <label for="Nome"> Username di coppia:</label>
                            <input class="form-input" type="text" name="nome" placeholder="Username che rappresenta la vostra unione :) " id="typeEmailX-2" maxlength="20" class="form-control"/> 
                            
                            <label for="Password"> Il vostro passlove: </label>
                            <input class="form-input" type="text" name="psw" placeholder="Inserire password" id="typePasswordX-2" maxlength="20" class="form-control"/>
                            
                            <div class="bottone lunghezza2">
                            <button class="form-input btnIniziale biancoVero contorno specLog" type="submit" name="login"> Entriamo! </button>
                            </div>

                        </div>
                    </form> 

                
                    <div id="login" class="posNC">
                        <a href="registrazione.php" class="linkNC" target="_blank">Regis</a>
                    </div>

                </div>
            </div>
        </div>
    </body>

    <script src="js/javascript.js"></script>
</html>
