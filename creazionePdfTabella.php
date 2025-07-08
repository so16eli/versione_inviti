<?php 
session_start();
$recapArrayTBCO= $_SESSION['recapDatiTabellaCompleta'];
$data = $_SESSION['dataAttuale'];
$totale = $_SESSION['conteggioTotale'];


$recapDatiTabellaCompleta= "";
foreach( $recapArrayTBCO as $key=>$value){
    $conteggio=$value[0];
    $nomeEcognome=$value[1];
    $esAlimentari=$value[2];
    $bisognoPassaggio=$value[3];

    $tabellaRiga = "<tr>
            <td style='padding-left:2%; padding:0.5%; border-bottom:1px solid #889a7a; border-bottom-width:3px;'>$conteggio</td>
            <td style='padding-left:2%; padding:0.5%; border-bottom:1px solid #889a7a; border-bottom-width:3px;'>$nomeEcognome</td>
            <td style='padding-left:2%; padding:0.5%; border-bottom:1px solid #889a7a; border-bottom-width:3px;'>$esAlimentari</td>
            <td style='padding-left:2%; padding:0.5%; border-bottom:1px solid #889a7a; border-bottom-width:3px;'>$bisognoPassaggio</td>
        </tr>";
    
    $recapDatiTabellaCompleta = $recapDatiTabellaCompleta . $tabellaRiga;
}

require_once('/membri/weddinginfomattemarty/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);


$dompdf ->loadHtml("
<body style='background-color:#fcffdf; padding: 5%;padding-top:10%; color:rgb(47, 45, 45);font-size: 18px;'> 
<div style='width:10%; margin-left:80%; color: #828340;'> $data </div>
<h2 style='font-size: 22px; font-weight: normal; line-height:28px;color: #828340; margin-top:5%; text-align:center;'>Matrimonio Matteo & Martina</h2>

<h2 style='font-size: 22px; font-weight: normal; line-height:28px;color: #828340; margin-left:5%; margin-top:10%;'> Tabella dei partecipanti e delle relative informazioni:</h2>

<table class='table' style=' border:1px solid #828340; border-width:1px; padding:1%; width:90%; margin-left:5%;'> 
<tr style='border: 1px solid #cfcdcd; border-bottom-width:5px;'>
<th style='padding:1%; padding-right:5%; text-align:left; width:25%;' >Partecipante</th>
<th style='padding:1%; padding-right:5%; text-align:left;'>Nome e cognome</th>
<th style='padding:1%; padding-right:5%; text-align:left;'>Esigenze alimentari</th>
<th style='padding:1%; padding-right:5%; text-align:left;'>Bisogno Passaggio</th>
</tr>
"
.$recapDatiTabellaCompleta."
 </table> 
   <div style='padding:4%; padding-left:7%; color: #828340;'>Totale: ".$totale." </div>
</body>");

$dompdf ->setPaper('A4', 'lnandscape');

$dompdf ->render();

$dompdf ->stream();

?>