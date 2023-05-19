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

// Titulo del formulario de citas

window.addEventListener('load', () => {
  const titleFormH1 = document.getElementById('titulo-formulario');
  const textoBoton = document.getElementById('buttonText');

  titleFormH1.innerHTML = location.hash.includes('formulario-seccion') ? 'Modificar cita' : 'Reservar cita';
  textoBoton.innerHTML = location.hash.includes('formulario-seccion') ? 'Modificar' : 'Reservar';

})

window.addEventListener('load', () => {
  const titleFormH1User = document.getElementById('titulo-formulario-user');
  const textoBotonUser = document.getElementById('buttonTextUser');

  titleFormH1User.innerHTML = location.hash.includes('formulario-user') ? 'Modificar usuario' : 'Crear usuario';
  textoBotonUser.innerHTML = location.hash.includes('formulario-user') ? 'Modificar' : 'Crear';

})




//Funcion para dar vuelta a carta

const btnChange = document.getElementById("btn-change-front");
const btnChangeFront = document.getElementById("btn-change");
const card = document.getElementById("card");

btnChange.addEventListener("click", () => {
  card.classList.add("card-flip");
});

btnChangeFront.addEventListener("click", () => {
  card.classList.remove("card-flip");
});






