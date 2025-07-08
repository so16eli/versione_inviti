<?php
    session_start();
    session_unset();
    session_destroy();

    ?>
  <html>
    <head>
        <link rel="stylesheet" href="css/stile.css">
    
    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="gestione">

<?php

    echo"  <p>  hai effettuato il logout correttamente  <br>    
    <a href='login.php' class='logout'>torna alla schermata di login</a><br><br>
    Verrai reinderizzato alla pagina principale in.. <span id='contatore'></span>
";
        ?>
        <script>

                var secondi = 5;
                var countdown = setInterval(timer, 1000);  
                
                function timer(){
                    document.querySelector("#contatore").innerHTML = secondi + " secondi";
                    secondi = secondi -1;
                    if(secondi <= 0){
                        clearInterval(countdown);
                        return;                       
                    }

                }
                    </script>
 <?php
        
    echo "secondi </p>";
    
?>
                </div>
              </body>
              </html>
                <script>
                setTimeout(function () {
                window.location.href= 'login.php';

                    },5000);
                </script>

 <?php


 exit; // Fine script

 ?>