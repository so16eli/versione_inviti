        

        function creazioneBolle(){

            var idiv = document.getElementsByClassName('infoColori');
    
             for(let c=0; c < idiv.length; c++){
                let div = idiv[c];

            const bolla = document.createElement("div");
            bolla.classList.add("bolla");
            bolla.style.left= Math.random()*90 + "%";
            bolla.style.top= Math.random()*100 + "%";

            bolla.style.width= "8%";
            bolla.style.height= "0.3vh";


            bolla.style.animationDuration = Math.random() * 2 + 3 + "s";

                
               div.appendChild(bolla);
            setTimeout(() => {bolla.remove()}, 4000);

            }

    } 

function azioneBolle(){
    
    for(let i = 0; i < 15; i++){
        setTimeout(
            creazioneBolle, i*100);
    }

}


        function creazioneBolleSpecifica(d){

           // var idiv = document.getElementsByClassName('infoColori');
    
           //    let div = idiv[d];

            const bolla = document.createElement("div");
            bolla.classList.add("bolla");
            bolla.style.left= Math.random()*90 + "%";
            bolla.style.top= Math.random()*100 + "%";

            bolla.style.width= "8%";
            bolla.style.height= "0.3vh";


            bolla.style.animationDuration = Math.random() * 2 + 3 + "s";

                
               d.appendChild(bolla);
            setTimeout(() => {bolla.remove()}, 12000);


    } 

function azioneBolleSpecifica(){
    
    for(let i = 0; i < 25; i++){
        setTimeout(
            creazioneBolleSpecifica, i*1000);
    }

}

