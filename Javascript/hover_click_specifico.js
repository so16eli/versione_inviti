
//QUANDO SI FA HOVER SULLE FOTO COMPARE UNA DESCRIZIONE

function fotoDidascalia(i) {
    var riquadro = document.getElementsByClassName("descrizione")[i];
    var citazione = document.getElementsByClassName("cit")[i];

    riquadro.style.animation="compareDalBasso 1s ease-in";

    setTimeout(
        function comparsa(){
        riquadro.style.display = "block";
        citazione.style.display = "block";}, 1000
    );

   

}

function sparisceDidascalia(i){
    var riquadro = document.getElementsByClassName("descrizione")[i];
    var citazione = document.getElementsByClassName("cit")[i];

    setTimeout(
        function scomparsa(){
        riquadro.style.display = "none";
        citazione.style.display = "none";}, 1000
    );

}

//Foto di <a href="https://pixabay.com/it/users/hoangdongphoto-22865572/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=6706278">Hoàng Đông Trịnh Lê</a> da <a href="https://pixabay.com/it//?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=6706278">Pixabay</a>
//Foto di <a href="https://pixabay.com/it/users/stocksnap-894430/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=2601156">StockSnap</a> da <a href="https://pixabay.com/it//?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=2601156">Pixabay</a>
//Foto di <a href="https://pixabay.com/it/users/thuanvo-14686516/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=5000549">Thuan Vo</a> da <a href="https://pixabay.com/it//?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=5000549">Pixabay</a>
//Foto di <a href="https://pixabay.com/it/users/aliceabc0-1104247/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=1779066">Alice Bitencourt</a> da <a href="https://pixabay.com/it//?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=1779066">Pixabay</a>