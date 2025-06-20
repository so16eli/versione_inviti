$i=1;

function aggiunta(){
var nuovoDiv= document.createElement("div");
nuovoDiv.className="col-3 col-md-4";

var contatore=$i;
nuovoDiv.setAttribute('id', contatore);
const formpiu = document.getElementById("aggiuntaForm");
/*nuovoDiv.innerHTML+='<div class="col-3 col-md-4">  <div class="busta"> <div class="striscia"> <span id="numeroForm"> form '+$i+' aggiunto </span> </div></div>'; */

nuovoDiv.innerHTML+='<div class="busta"><div class="striscia"></div><div class="form"> <h3> Form partecipazione </h3><label for="Nome"> Indica il tuo nome</label><input class="form-input" type="text" name="nome[]" placeholder="Inserisci nome e cognome" maxlength="40" minlength="6" required/> </br><label for="Esigenze Alimentari"> Hai delle allergie, intolleranze o altre esigenze alimentari? </label><textarea rows="3" class="form-input" name="alimentazione[insieme'+$i+']" placeholder="Inserisci qui eventuali esigenze alimentari...(massimo 150 caratteri)" maxlength="150"></textarea> <label for="Esigenze Alimentari" ><input class="typeRadio" type="radio" name="alimentazione[insieme'+$i+']" value="Null"/>  <span>Non ho esigenze alimentari</span><span style="color:#e4e47c;" onclick="resetRadio(&apos;alimentazione[insieme'+$i+']&apos;);"> &nbsp;&nbsp;(X)</span> </label> <div class="colonne"><label for="eta"> Indicare età se si si sta compilando il form per un minorenne sotto i 10 anni</label><input class="form-input" type="text" name="eta[]" placeholder="Età" maxlength="3" style="width:25% !important; margin-right: 12% !important ;" /></div><br><br><br></div> </div>';
formpiu.insertAdjacentElement("afterend", nuovoDiv);

$i++;
return $i;
}