<?php 
session_start();
$recapArrayEta= $_SESSION['recapDatiTabellaEta'];
$data = $_SESSION['dataAttuale'];
$totaleE = $_SESSION['conteggioTotaleEta'];


$recapDatiTabellaEta= "";
foreach( $recapArrayEta as $key=>$value){
    $nomeEcognome=$value[0];
    $eta=$value[1];

    $tabellaRigaE = "<tr>
            <td style='padding-left:2%; padding:0.5%; border-bottom:1px solid #889a7a; border-bottom-width:3px;'>$nomeEcognome</td>
            <td style='padding-left:2%; padding:0.5%; border-bottom:1px solid #889a7a; border-bottom-width:3px;'>$eta</td>
        </tr>";
    
    $recapDatiTabellaEta = $recapDatiTabellaEta . $tabellaRigaE;
}

require_once('/membri/weddinginfomattemarty/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);


$dompdf ->loadHtml("
<body style='background-color:#fcffdf; padding: 5%;padding-top:10%; color:rgb(47, 45, 45);font-size: 18px;'> 
<div style='width:10%; margin-left:80%; color: #828340;'>". $data ."</div>
<h2 style='font-size: 22px; font-weight: normal; line-height:28px;color: #828340; margin-top:5%; text-align:center;'>Matrimonio Matteo & Martina</h2>

<h2 style='font-size: 20px; font-weight: normal; line-height:28px;color: #828340; margin-left:5%; margin-top:10%;'> Tabella con i partecipanti che hanno un'età minore di 10</h2>

<table class='table' style=' border:1px solid #828340; border-width:1px; padding:1%; width:70%; margin-left:5%;'> 
<tr style='border: 1px solid #cfcdcd; border-bottom-width:5px;'>
<th style='padding:1%; padding-right:5%; text-align:left; width:90%;' >Nome e cognome</th>
<th style='padding:1%; padding-right:5%; text-align:left;'>Età</th>
</tr>
"
.$recapDatiTabellaEta."
 </table> 
  <div style='padding:4%; padding-left:7%; color: #828340;'>Totale: ".$totaleE." </div>

</body>");

$dompdf ->setPaper('A4', 'lnandscape');

$dompdf ->render();

$dompdf ->stream();

?>