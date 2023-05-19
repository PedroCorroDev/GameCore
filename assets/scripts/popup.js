window.addEventListener('load', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const voltear = urlParams.get('voltear');
    const popupClose = document.getElementById('popupClose');
    const popupContainer = document.getElementById('popupContainer');
  
    if (voltear == "1") {
        document.getElementById('btn-change-front').click();
    }
  
    const validado = urlParams.get('validado');
    if (validado == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "El registro se ha efectuado correctamente.";
      
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
      });
    }
    const validadoAdmin = urlParams.get('validadoAdmin');
    if (validadoAdmin == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "El registro se ha efectuado correctamente.";
      
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
      });
    }
  
      
    const logged = urlParams.get('logged');
    if (logged == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Has accedido a tu cuenta correctamente.";
      document.getElementById("errorLogin").style.display = "none";
  
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../index.php");
      });
    }
    if (logged == "0"){
      document.getElementById("errorLogin").innerHTML = "El usuario y la contraseña no coinciden.";
    }  
  
    const actualizado = urlParams.get('actualizado');
    if (actualizado == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Se han modificado correctamente los datos.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/perfil.php");
      });
    }

    const reserva = urlParams.get('reserva');
    if (reserva == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Se han modificado correctamente los datos.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/citas.php");
      });
    }

    const erased = urlParams.get('erased');
    if (erased == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Se ha eliminado la cita.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/citas.php");
      });
    }

    const modificado = urlParams.get('modificado');
    if (modificado == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "La cita se ha modificado.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/citas.php");
      });
    }

    const erasedAdmin = urlParams.get('erasedAdmin');
    if (erasedAdmin == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Se ha eliminado el usuario.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/usuarios_admin.php");
      });
    }

    const modificadoAdmin = urlParams.get('modificadoAdmin');
    if (modificadoAdmin == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "El usuario se ha modificado.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/usuarios_admin.php");
      });
    }

    const erasedCitaAdmin = urlParams.get('erasedCitaAdmin');
    if (erasedCitaAdmin == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Se ha eliminado la cita.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/citas_admin.php");
      });
    }

    const reservaAdmin = urlParams.get('reservaAdmin');
    if (reservaAdmin == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Se ha reservado la cita.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/citas_admin.php");
      });
    }
    
    const modificadaCitaAdmin = urlParams.get('modificadaCitaAdmin');
    if (modificadaCitaAdmin == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Se ha modificado la cita.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/citas_admin.php");
      });
    }

    const adminnew = urlParams.get('adminnew');
    if (adminnew == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Se ha añadido la noticia.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/noticias_admin.php");
      });
    }

    const erasedNoticia = urlParams.get('erasedNoticia');
    if (erasedNoticia == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Se ha eliminado la noticia.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/noticias_admin.php");
      });
    }

    const modificadaNewAdmin = urlParams.get('modificadaNewAdmin');
    if (modificadaNewAdmin == "1"){
      document.getElementById('popupContainer').style.display = "block";
      document.getElementById('popupContainer').style.position = "fixed";
      document.getElementById('popupMensaje').innerHTML = "Se ha modificado la noticia.";
  
      popupClose.addEventListener('click', () => {
        popupContainer.style.display = "none";
        window.location.replace("../views/noticias_admin.php");
      });
    }
    
  })






  function confirmarEliminacionAdmin(idUser) {
    const userEliminarAdmin = "formularioEliminarUser" + idUser;
    document.getElementById('popupContainer').style.display = "block";
    document.getElementById('popupContainer').style.position = "fixed";
    document.getElementById('popupMensaje').innerHTML = "¿Estás seguro que quieres eliminar este usuario?";
  
    popupClose.addEventListener('click', () => {
      popupContainer.style.display = "none";
      window.location.replace("../views/usuarios_admin.php");
    });
  
    document.getElementById("check-group").addEventListener("mouseover", () =>{
      document.getElementById("svg").style.transform = "scale(0.8)";
      document.getElementById("svg").style.transition = "transform 0.3s ease-in-out";
  
    })
    document.getElementById("check-group").addEventListener("mouseout", () =>{
      document.getElementById("svg").style.transform = "scale(1)";
    })
  
    document.getElementById("check-group").addEventListener("click", (e) =>{
      document.getElementById(userEliminarAdmin).submit();
    })
  }

  

  function confirmarEliminacion(idCita) {
    const citaEliminar = "formularioEliminarCita" + idCita;
    document.getElementById('popupContainer').style.display = "block";
    document.getElementById('popupContainer').style.position = "fixed";
    document.getElementById('popupMensaje').innerHTML = "¿Estás seguro que quieres eliminar la cita?";

    popupClose.addEventListener('click', () => {
      popupContainer.style.display = "none";
      window.location.replace("../views/citas.php");
    });

    document.getElementById("check-group").addEventListener("mouseover", () =>{
      document.getElementById("svg").style.transform = "scale(0.8)";
      document.getElementById("svg").style.transition = "transform 0.3s ease-in-out";

    })
    document.getElementById("check-group").addEventListener("mouseout", () =>{
      document.getElementById("svg").style.transform = "scale(1)";
    })

    document.getElementById("check-group").addEventListener("click", (e) =>{
      document.getElementById(citaEliminar).submit();
    })
  }
  

  const expandirAdmin = () => {
    document.getElementById("recursos_administracion").style.display = 'grid';
    document.getElementById("closeAdmin").addEventListener("click", () => {
  
        document.getElementById("recursos_administracion").style.display = 'none';
    })
  }

  function confirmarEliminacionCitaAdmin(idCita) {
    const citaEliminarAdmin = "formularioEliminarCitaAdmin" + idCita;
    document.getElementById('popupContainer').style.display = "block";
    document.getElementById('popupContainer').style.position = "fixed";
    document.getElementById('popupMensaje').innerHTML = "¿Estás seguro que quieres eliminar la cita?";

    popupClose.addEventListener('click', () => {
      popupContainer.style.display = "none";
      window.location.replace("../views/citas_admin.php");
    });

    document.getElementById("check-group").addEventListener("mouseover", () =>{
      document.getElementById("svg").style.transform = "scale(0.8)";
      document.getElementById("svg").style.transition = "transform 0.3s ease-in-out";

    })
    document.getElementById("check-group").addEventListener("mouseout", () =>{
      document.getElementById("svg").style.transform = "scale(1)";
    })

    document.getElementById("check-group").addEventListener("click", (e) =>{
      document.getElementById(citaEliminarAdmin).submit();
    })
  }

  function confirmarEliminacionNoticia(idNoticia) {
    const formularioEliminarNoticia = "formularioEliminarNoticia" + idNoticia;
    document.getElementById('popupContainer').style.display = "block";
    document.getElementById('popupContainer').style.position = "fixed";
    document.getElementById('popupMensaje').innerHTML = "¿Estás seguro que quieres eliminar esta noticia?";
  
    popupClose.addEventListener('click', () => {
      popupContainer.style.display = "none";
      window.location.replace("../views/noticias_admin.php");
    });
  
    document.getElementById("check-group").addEventListener("mouseover", () =>{
      document.getElementById("svg").style.transform = "scale(0.8)";
      document.getElementById("svg").style.transition = "transform 0.3s ease-in-out";
  
    })
    document.getElementById("check-group").addEventListener("mouseout", () =>{
      document.getElementById("svg").style.transform = "scale(1)";
    })
  
    document.getElementById("check-group").addEventListener("click", (e) =>{
      document.getElementById(formularioEliminarNoticia).submit();
    })
  }

 



