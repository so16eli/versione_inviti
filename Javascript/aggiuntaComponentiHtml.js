$i=1;
const formpiu = document.getElementById("aggiuntaForm");
let ultimoInserito = formpiu;



function aggiunta(){
var nuovoDiv= document.createElement("div");
nuovoDiv.className="col-sm-12 col-md-12 col-lg-9  col-xl-4";

var contatore=$i;
nuovoDiv.setAttribute('id', contatore);


nuovoDiv.innerHTML+='<div class="busta contForm"><div class="striscia"></div><div class="form"> <h3> Form partecipazione </h3><label for="Nome"> Indica il tuo nome</label><input class="form-input" type="text" name="nome[]" placeholder="Inserisci nome e cognome" maxlength="40" minlength="6" required/> </br><label for="Esigenze Alimentari"> Hai delle allergie, intolleranze o altre esigenze alimentari? </label><textarea rows="3" class="form-input" name="alimentazione[insieme'+$i+']" placeholder="Inserisci qui eventuali esigenze alimentari...(massimo 150 caratteri)" maxlength="150"></textarea> <label for="Esigenze Alimentari" ><input class="typeRadio" type="radio" name="alimentazione[insieme'+$i+']" value="Null"/>  <span>Non ho esigenze alimentari</span><span style="color:#e4e47c;" onclick="resetRadio(&apos;alimentazione[insieme'+$i+']&apos;);"> &nbsp;&nbsp;(X)</span> </label> <div class="colonne"><label for="eta"> Indicare età se si si sta compilando il form per un minorenne sotto i 10 anni</label><input class="form-input" type="text" name="eta[]" placeholder="Età" maxlength="3" style="width:25% !important; margin-right: 12% !important ;" /></div><br><br><br></div> </div>';
ultimoInserito.insertAdjacentElement("afterend", nuovoDiv);
ultimoInserito = nuovoDiv;

$i++;
return $i;
}