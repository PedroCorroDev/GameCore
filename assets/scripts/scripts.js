/*-*-*-*-* Función para cambiar el tema de la web *-*-*/
$(document).ready(() => {
    $('#toggle-checkbox').on('change', () => { //Checkbox con funcion de cambio de colores
       if ($('#toggle-checkbox').is(':checked')){ //Si está seleccionado, cambiar colores a paleta oscura
           document.documentElement.style.setProperty('--bg-color-principal', '#292c35');
           document.documentElement.style.setProperty('--main-text-color', 'white');
           document.documentElement.style.setProperty('--toggle-bg', 'purple');
           document.documentElement.style.setProperty('--toggle-ball', '#292c35');
       } else { //Si está deseleccionado, cambia colores a paleta clara
           document.documentElement.style.setProperty('--bg-color-principal', 'white');
           document.documentElement.style.setProperty('--main-text-color', 'black');
           document.documentElement.style.setProperty('--toggle-bg', '#fcc474');
           document.documentElement.style.setProperty('--toggle-ball', 'white');
       }
    });
  }); 

/*-*-*-*-* Función navegación sticky *-*-*/
const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
    const scrollPos = window.scrollY;
    if (scrollPos > 1) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

/*Libreria dinamica*/ 

const sliderImages = [
    {id: '0', img:'./assets/img/game-bg.jpg', title:'¡Aventuras épicas en el mundo digital!', seccion: '#seccion1',  descripcion: 'Venid a disfrutar de nuestro gran repertorio de videojuegos. Para todas las edad y todas las categorías. ¡Sin necesidad de reserva!'},
    {id: '1', img:'./assets/img/esports-bg.jpg', title:'¡El escenario de los campeones!', seccion: '#seccion2',   descripcion:'¡Vive con nosotros los mayores torneos de eSports de alto nivel! Ofrecemos una amplia elección de deportes electrónicos para disfrutar en nuestras mejores televisiones.'},
    {id: '2', img:'./assets/img/entretenimiento-bg.jpg', title:'¡Explora mundos fantásticos!', seccion: '#seccion3',  descripcion:'Sumérgete en nuestros emocionantes mundos de anime y manga. Personajes cautivadores y aventuras inolvidables te esperan aquí. ¡Sin comisiones!'},
];

let i = 0; 

window.addEventListener('load', () => {
    
    document.getElementsByClassName('hero')[0].style.backgroundImage = "linear-gradient(rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.2) 10%,rgba(0,0,0,0) 15%,rgba(0,0,0,0) 80%, rgba(0,0,0,0.4) 90%, rgba(0,0,0,0.8) 100%), url('" + sliderImages[i].img + "')";
    document.getElementsByClassName('hero')[0].style.backgroundSize = "cover";
    document.getElementsByClassName('hero')[0].style.backgroundRepeat = "no-repeat";
    document.getElementsByClassName('hero')[0].style.backgroundPosition = "center center";

    document.getElementById('descripcion-header').innerHTML = sliderImages[i].descripcion;
    document.getElementById('titulo-header').innerHTML = sliderImages[i].title;
    document.getElementById('botonHero').href = sliderImages[i].seccion;

  
    function changeHeader() { 
        document.getElementsByClassName('hero')[0].style.backgroundImage = "linear-gradient(rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.2) 10%,rgba(0,0,0,0) 15%,rgba(0,0,0,0) 80%, rgba(0,0,0,0.4) 90%, rgba(0,0,0,0.8) 100%), url('" + sliderImages[i].img + "')";
        document.getElementById('descripcion-header').innerHTML = sliderImages[i].descripcion;
        document.getElementById('titulo-header').innerHTML = sliderImages[i].title;
        document.getElementById('botonHero').href = sliderImages[i].seccion;


        i++;
        if(i == sliderImages.length){ 
            i=0;
        }
    }

    let intervalID = setInterval(changeHeader, 4000);
});


/*Efecto de carta que gira entorno al ratón*/

window.addEventListener('load', () => {

    const el1 = document.getElementById('poster1');
    const el2 = document.getElementById('poster2');
    const el3 = document.getElementById('poster3');
    const el4 = document.getElementById('poster4');
    const el5 = document.getElementById('poster5');
    const el6 = document.getElementById('poster6');

    const height = el1.clientHeight;
    const width = el1.clientWidth;

    el1.addEventListener('mousemove', (e) => {
        const {layerX, layerY} = e;
        const yRotation = (
            (layerX -width/2) / width
        ) * 20;

        const xRotation = (
            (layerY -height/2) / height
        ) * 20;

        const string = `
            perspective(500px)
            scale(1.1)
            rotateX(${xRotation}deg)
            rotateY(${yRotation}deg)
        `;
        el1.style.transform = string
    })

    el1.addEventListener('mouseout', () =>{
        el1.style.transform = `
        perspective(500px)
        scale(1)
        rotateX(0)
        rotateY(0)
        `;
    })



    const height2 = el2.clientHeight;
    const width2 = el2.clientWidth;

    el2.addEventListener('mousemove', (e) => {
        const {layerX, layerY} = e;
        const yRotation = (
            (layerX -width2/2) / width2
        ) * 20

        const xRotation = (
            (layerY -height2/2) / height2
        ) * 20

        const string = `
            perspective(500px)
            scale(1.1)
            rotateX(${xRotation}deg)
            rotateY(${yRotation}deg)
        `
        el2.style.transform = string
    })

    el2.addEventListener('mouseout', () =>{
        el2.style.transform = `
        perspective(500px)
        scale(1)
        rotateX(0)
        rotateY(0)
        `
    })

    const height3 = el3.clientHeight;
    const width3 = el3.clientWidth;

    el3.addEventListener('mousemove', (e) => {
        const {layerX, layerY} = e;
        const yRotation = (
            (layerX -width3/2) / width3
        ) * 20

        const xRotation = (
            (layerY -height3/2) / height3
        ) * 20

        const string = `
            perspective(500px)
            scale(1.1)
            rotateX(${xRotation}deg)
            rotateY(${yRotation}deg)
        `
        el3.style.transform = string
    })

    el3.addEventListener('mouseout', () =>{
        el3.style.transform = `
        perspective(500px)
        scale(1)
        rotateX(0)
        rotateY(0)
        `
    })

    const height4 = el4.clientHeight;
    const width4 = el4.clientWidth;

    el4.addEventListener('mousemove', (e) => {
        const {layerX, layerY} = e;
        const yRotation = (
            (layerX -width4/2) / width4
        ) * 20

        const xRotation = (
            (layerY -height4/2) / height4
        ) * 20

        const string = `
            perspective(500px)
            scale(1.1)
            rotateX(${xRotation}deg)
            rotateY(${yRotation}deg)
        `
        el4.style.transform = string
    })

    el4.addEventListener('mouseout', () =>{
        el4.style.transform = `
        perspective(500px)
        scale(1)
        rotateX(0)
        rotateY(0)
        `
    })

    const height5 = el5.clientHeight;
    const width5 = el5.clientWidth;

    el5.addEventListener('mousemove', (e) => {
        const {layerX, layerY} = e;
        const yRotation = (
            (layerX -width5/2) / width5
        ) * 20

        const xRotation = (
            (layerY -height5/2) / height5
        ) * 20

        const string = `
            perspective(500px)
            scale(1.1)
            rotateX(${xRotation}deg)
            rotateY(${yRotation}deg)
        `
        el5.style.transform = string
    })

    el5.addEventListener('mouseout', () =>{
        el5.style.transform = `
        perspective(500px)
        scale(1)
        rotateX(0)
        rotateY(0)
        `
    })
    const height6 = el6.clientHeight;
    const width6 = el6.clientWidth;

    el6.addEventListener('mousemove', (e) => {
        const {layerX, layerY} = e;
        const yRotation = (
            (layerX -width6/2) / width6
        ) * 20

        const xRotation = (
            (layerY -height6/2) / height6
        ) * 20

        const string = `
            perspective(500px)
            scale(1.1)
            rotateX(${xRotation}deg)
            rotateY(${yRotation}deg)
        `
        el6.style.transform = string
    })

    el6.addEventListener('mouseout', () =>{
        el6.style.transform = `
        perspective(500px)
        scale(1)
        rotateX(0)
        rotateY(0)
        `
    })

}) 

const expandirAdmin = () => {
    document.getElementById("recursos_administracion").style.display = 'grid';
    document.getElementById("closeAdmin").addEventListener("click", () => {

        document.getElementById("recursos_administracion").style.display = 'none';
    })
}

