/* DESCRIZIONE ELEMENTI 
gpgpuSize: 500
Risoluzione della griglia di simulazione (maggiore = più particelle, ma più pesante).

colors: [0x7692FF, 0x0acdc6]
Colori tra cui sfumano le particelle (blu e verde acqua in questo caso).

color: 0x51c8c4
Colore principale o di fallback per le particelle (verde acqua chiaro).

background: 'transparent'
Sfondo trasparente.

coordScale: 0.5
Scala delle coordinate usate per muovere le particelle (0.5 = movimento più contenuto).

noiseIntensity: 0.0015
Intensità del rumore che disturba/muove le particelle.

noiseTimeCoef: 0.01
Quanto velocemente cambia nel tempo il rumore.

pointSize: 4
Dimensione delle particelle.

pointDecay: 0.005
Velocità con cui le particelle si dissolvono o decadono.

sleepRadiusX/Y: 10
Area (in X e Y) attorno a cui le particelle rallentano o “dormono”.

sleepTimeCoefX/Y: 0.0015
Quanto velocemente le particelle si mettono a “dormire” lungo X e Y. */


import { particlesCursor } from 'https://unpkg.com/threejs-toys@0.0.8/build/threejs-toys.module.cdn.min.js'



const puntatore = particlesCursor({
 el: document.getElementById('puntatore'),
  gpgpuSize: 15,
  colors: [0x7692FF, 0x0acdc6],
  color: 0xf6f178,
  background: 'transparent',
  coordScale: 2,
  noiseIntensity: 0.003,
  noiseTimeCoef: 0.015,
  pointSize: 5,
  pointDecay: 0.0015,
  sleepRadiusX: 10,
  sleepRadiusY: 10,
  sleepTimeCoefX: 0.05,
  sleepTimeCoefY: 0.05,
});


/*const waitForRenderer = () => {
  if (puntatore && puntatore.renderer) {

    puntatore.renderer.setClearColor(0xf9f5f9, 1); // Bianco molto chiaro
    puntatore.renderer.setClearAlpha(1); // Nessuna trasparenza
    puntatore.renderer.autoClear = true;
  } else {

    setTimeout(waitForRenderer, 100);
  }
};

waitForRenderer(); */


console.log('Renderer:', puntatore.renderer);
console.log('Scene:', puntatore.scene);
console.log('Camera:', puntatore.camera);


setTimeout(() => {
  const canvas = document.querySelector('#puntatore canvas');
  //canvas.style.borderBottom = '200px solid white';

  if (canvas) {
    canvas.style.backgroundColor = 'transparent';
    canvas.style.zIndex = 1;
  }
}, 100);

/*
document.body.addEventListener('click', () => {
  puntatore.uniforms.uColor.value.set(Math.random() * 0xff0000)
  puntatore.uniforms.uCoordScale.value = 0.001 + Math.random() * 2
  puntatore.uniforms.uNoiseIntensity.value = 0.0001 + Math.random() * 0.001
  puntatore.uniforms.uPointSize.value = 1 + Math.random() * 10
}) */