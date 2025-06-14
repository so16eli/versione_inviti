
//QUELLO CHE COMPARE ALLO SCORRERE DELLA PAGINA...

// ...QUANDO CI SI FERMA SULLA SEZIONE DELLE BUSTE
const osservaBuste = new IntersectionObserver(entries => {

    entries.forEach(entry => {

        if(entry.isIntersecting){
                document.getElementsByClassName("chiusura")[0].style.animation = " tendaAperta 2s ease-in-out 0.5s";
                document.getElementsByClassName("chiusura")[1].style.animation = " tendaAperta 2s ease-in-out 1.5s";
                document.getElementsByClassName("chiusura")[2].style.animation = " tendaAperta 2s ease-in-out 2.5s";

                document.getElementsByClassName("busta")[0].style.animation = "compareDalBassoVeloceMeno 3s ease";
                document.getElementsByClassName("busta")[1].style.animation = "compareDalBassoVeloceMeno 5s ease";
                document.getElementsByClassName("busta")[2].style.animation = "compareDalBassoVeloceMeno 7s ease";

                document.getElementsByClassName("comparsa1")[1].style.animation = " compareDalBassoVeloceTappe 1s ease";
                document.getElementsByClassName("comparsa1")[2].style.animation = " compareDalBassoVeloceTappe 1s ease";


                document.getElementsByClassName("spazioBianco")[0].style.animation = "sfondoSparisce 4s ease";

                document.getElementsByClassName("colori")[0].style.animation = "colorsAnimation 5s ease";
                document.getElementsByClassName("colori")[1].style.animation = "colorsAnimation 4.5s ease 0.05s";
                document.getElementsByClassName("colori")[2].style.animation = "colorsAnimation 4s ease 0.10s";
                document.getElementsByClassName("colori")[3].style.animation = "colorsAnimation 3.5s ease 0.15s";
                document.getElementsByClassName("colori")[4].style.animation = "colorsAnimation 3s ease 0.20s";


                azioneBolle();
            }

    })

}

)

osservaBuste.observe(document.getElementsByClassName("intro")[1]);

// ...QUANDO CI SI FERMA SULLA SEZIONE DEI FORM


const osservaForm = new IntersectionObserver(entries => {

    entries.forEach(entry => {

        if(entry.isIntersecting){
            document.getElementsByClassName("comparsa1")[3].style.animation = " compareDalBassoVeloceTappe 1s ease";

        }
    })
})
osservaForm.observe(document.getElementsByClassName("intro")[2]);


const osservaprimaDiTabella = new IntersectionObserver(entries => {

    entries.forEach(entry => {

        if(entry.isIntersecting){
            document.getElementsByClassName("comparsa1")[4].style.animation = " compareDalBassoVeloceTappe 1s ease 0.5s";

        }
    })
})
osservaprimaDiTabella.observe(document.getElementsByClassName("parteSeconda")[0]);




// ...QUANDO CI SI FERMA SULLA SEZIONE DELLE FOTO

const osservaFoto = new IntersectionObserver(entries => {

    entries.forEach(entry => {

        if(entry.isIntersecting){
            document.getElementsByClassName("descrizione")[0].style.animation="compareDalBasso 1s ease-in 0.3s";
            
        }

    })

}

)

osservaFoto.observe(document.getElementsByClassName("promemoria")[0]);

//secondo blocco di foto (dettaglio specifico)

const osservaFoto2 = new IntersectionObserver(entries => {

    entries.forEach(entry => {

        if(entry.isIntersecting){
            document.getElementsByClassName("descrizione")[1].style.animation="compareDalBasso 1s ease-in 0.3s";

        }

    })

}
)

osservaFoto2.observe(document.getElementsByClassName("parallasseSU")[0]);


//QUANDO CI SI FERMA SULLA SEZIONE DELLE TABELLE

const osservaTabelle = new IntersectionObserver(entries => {

    entries.forEach(entry => {

        if(entry.isIntersecting){
            document.getElementsByClassName("tabella")[0].style.animation="compareDalBasso 1s ease-in 0.2s";
            document.getElementsByClassName("tabella")[1].style.animation="compareDalBasso 1s ease-in 0.6s";
            
        }

    })

}
)

osservaTabelle.observe(document.getElementsByClassName("parallasseSU")[1]);
