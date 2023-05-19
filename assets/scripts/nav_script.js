window.addEventListener('load', () => {

  let currentPage = window.location.pathname.split('/').pop();

  // Seleccionar todos los elementos <a> dentro del selector nav
  let navLinks = document.querySelectorAll('#nav a');
  
  // Recorrer los enlaces y modificar su href y clase
  for (let i = 0; i < navLinks.length; i++) {
    let link = navLinks[i];
    let linkId = link.getAttribute('id');
  
    // Verificar si el ID del enlace coincide con la URL actual
    if (currentPage == linkId + ".php") {
      // Actualizar el valor href para volver a la página actual
      link.href = "#";
  
      // Añadir la clase "active" al enlace
      link.classList.add('actual-page');
    }
  }
  


  let navLinks2 = document.querySelectorAll('#nav2 a');

  // Recorrer los enlaces y modificar su href y clase
  for (let i = 0; i < navLinks2.length; i++) {
    let link2 = navLinks2[i];
    let linkId2 = link2.getAttribute('id');

    // Verificar si el ID del enlace coincide con el nombre de la página actual
    if (linkId2 && currentPage.indexOf(linkId2) !== -1) {
      // Actualizar el valor href para volver a la página actual
      link2.href = "#";

      // Añadir la clase "active" al enlace
      link2.classList.add('actual-page');
    }
  }

})