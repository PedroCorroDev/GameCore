<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Core</title>
    <script src="https://kit.fontawesome.com/926d45081f.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.png">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/secondary.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Marko+One&family=Pacifico&display=swap" rel="stylesheet">    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="../assets/scripts/nav_script.js"></script>


</head>
<body>


<?php
include '../includes/header.php';
?>
<div id="popupContainer">
  <div class="popupFlex">
    <i class="fa-sharp fa-regular fa-circle-xmark" id="popupClose"></i>
    <div id="svg">
      <svg width="133px" height="133px" viewBox="0 0 133 133" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <g id="check-group" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <circle id="filled-circle" fill="#78B348" cx="66.5" cy="66.5" r="54.5"></circle>
        <circle id="white-circle" fill="#FFFFFF" cx="66.5" cy="66.5" r="55.5"></circle>
        <circle id="outline" stroke="#78B348" stroke-width="4" cx="66.5" cy="66.5" r="54.5"></circle>
        <polyline id="check" stroke="#FFFFFF" stroke-width="4" points="41 70 56 85 92 49"></polyline>
      </g>
      </svg>
    </div>
    <span id="popupMensaje"></span>
  </div>  
</div>  

<main> 
  <div class="contenedor seccion">
    <div class="form">
      <div class="card" id="card">
        <div class="front">
          <h1>Login</h1>
          <form action="../includes/procesar_login.php" method="POST" class="form-front">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div id="errorLogin"></div>
            <div>
              <button type="submit" class="button"> <span class=text>Login</span></button>
              <p>¿Todavía no estás registrado? <span id="btn-change-front">¡Registrate!</span></p>
            </div>
          </form>
        </div>

        <?php
          //Recogemos las variables que vienen por URL al validar el formulario.

          $nombre = filter_input(INPUT_GET, "nombre", FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH);
          $apellidos = filter_input(INPUT_GET, "apellidos", FILTER_SANITIZE_STRING);
          $email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_EMAIL);
          $telefono = filter_input(INPUT_GET, "telefono", FILTER_SANITIZE_NUMBER_INT);
          $fecha_nacimiento = filter_input(INPUT_GET, "fecha_nacimiento", FILTER_SANITIZE_STRING);
          $usuario = filter_input(INPUT_GET, "usuario", FILTER_SANITIZE_STRING);
          $contrasenya = filter_input(INPUT_GET, "contrasenya", FILTER_SANITIZE_STRING);
          $userComprobacion = filter_input(INPUT_GET, "comprobacionUsuario", FILTER_SANITIZE_STRING);
          $emailComprobacion = filter_input(INPUT_GET, "comprobacionEmail", FILTER_SANITIZE_EMAIL);
          $telefonoComprobacion = filter_input(INPUT_GET, "comprobacionTelefono", FILTER_SANITIZE_NUMBER_INT);

          //Creamos mensajes de error
          $err0 = "El nombre no puede estar vacío.";
          $err1 = "El apellido no puede estar vacío.";
          $err2 = "El email debe ser un correo válido.";
          $err3 = "El teléfono debe ser un número.";
          $err4 = "La fecha de nacimiento no puede estar vacía.";
          $err5 = "El usuario no puede estar vacío.";
          $err6 = "La contraseña no puede estar vacía.";

          $errComp0 = "Este usuario ya está en uso.";
          $errComp1 = "Este email ya esta registrado.";
          $errComp2 = "Este telefono ya está asignado a una cuenta.";
        ?>

        <div class="back">
          <h1>Registro</h1>
          <form action="../includes/validacion_formulario.php" method="POST" class="form-back">
            <ul>
              <li>
                <div>
                  <label for="nombre">Nombre:</label>
                  <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre" value="<?php echo ($nombre == 1)?"":$nombre;?>" required>
                </div>
                <span><?php echo ($nombre == 1)?$err0:"";?></span>
              </li>
              <li>
                <div>
                  <label for="apellidos">Apellidos:</label>
                  <input type="text" id="apellidos" name="apellidos" placeholder="Escribe tus apellidos" value="<?php echo ($apellidos == 1)?"":$apellidos; ?>" required>
                </div>
                <span><?php echo ($apellidos == 1)?$err1:"";?></span>
              </li>
              <li>
                <div>
                  <label for="email">Email:</label>
                  <input type="email" id="email" name="email" placeholder="Escribe tu correo electrónico" value="<?php echo ($email == 1)?"":$email; ?>" required>
                </div>
                <span><?php echo ($email == 1)?$err2:""; echo ($emailComprobacion == 1)?$errComp1:"";?></span>
              </li>
              <li>
                <div>
                  <label for="telefono">Teléfono:</label>
                  <input type="tel" id="telefono" name="telefono" placeholder="Escribe tu teléfono" value="<?php echo ($telefono == 1)?"":$telefono; ?>" required>
                </div>
                <span> <?php echo ($telefono == 1)?$err3:"";?></span><span><?php echo ($telefonoComprobacion == 1)?$errComp2:"";?></span>
              </li>
              <li>
                <div>
                  <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                  <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo ($fecha_nacimiento == 1)?"":$fecha_nacimiento; ?>" required>
                </div>
                <span><?php echo ($fecha_nacimiento == 1)?$err4:"";?></span>
              </li>
              <li>
                <div>
                  <label for="direccion">Dirección:</label>
                  <textarea id="direccion" name="direccion" placeholder="Escribe tu dirección (Opcional)"></textarea>
                </div>
              </li>
              <li>
                <div>
                  <label for="sexo">Sexo:</label>
                  <select id="sexo" name="sexo">
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                  </select>
                </div>
              </li>
              <li>
                <div>
                  <label for="usuario">Usuario:</label>
                  <input type="text" id="usuario" name="usuario" placeholder="Escribe tu usuario" value="<?php echo ($usuario == 1)?"":$usuario; ?>" required>
                </div>
                <span><?php echo ($usuario == 1)?$err5:""; echo ($userComprobacion == 1)?$errComp0:"";?></span>
              </li>
              <li>
                <div>
                  <label for="contrasenya">Contraseña:</label>
                  <input type="password" id="contrasenya" name="contrasenya" placeholder="Escribe tu contraseña" value="<?php echo ($contrasenya == 1)?"":$contrasenya; ?>" required>
                </div>
                <span><?php echo ($contrasenya == 1)?$err6:"";?></span>
              </li>
              <li>
                <label for="rol">Rol:</label>
                <select id="rol" name="rol">
                  <option value="admin">Administrador</option>
                  <option value="user" selected>Usuario</option>
                </select>
              </li>
            </ul>
            <div>
              <button type="submit" class="button"> <span class=text>Registrarse</span></button>
              <p>¿Ya tienes una cuenta? <span id="btn-change">¡Conéctate!</span></p>
            </div>
          </form>
        </div>
      </div>


      
    <aside class="form-aside">
      <h2>
        ¡Sube de nivel!
      </h2>
      <p>
        Al hacerte socio de GameCore, obtendrás un registro de puntos por cada reserva o compra que realices en nuestro local.
        
        Cuando acumules muchos puntos, podrás obtener mejoras super guays, ¡cada cliente es único, animate! 
      </p>
      <ul>
        <li>
          <h2>Aventurero Novicio</h2>
          <p> 1000 Puntos GameCore</p>
          <p>Obtienes un descuento del 5% en cualquier compra.</p>  
        </li>
        <li>
          <h2>Guerrero</h2>
          <p> 3000 Puntos GameCore</p>
          <p>Obtienes un descuento del 5% en cualquier compra.</p>  
        </li>
        <li>
          <h2>Héroe</h2>
          <p> 5000 Puntos GameCore</p>
          <p>Obtienes un descuento del 5% en cualquier compra.</p>  
        </li>
        <li>
          <h2>Paladín</h2>
          <p> 7000 Puntos GameCore</p>
          <p>Obtienes un descuento del 5% en cualquier compra.</p>  
        </li>
        <li>
          <h2>Leyenda</h2>
          <p> 10000 Puntos GameCore</p>
          <p>Obtienes un descuento del 5% en cualquier compra.</p>  
        </li>
      </ul>
      
    </aside>

    </div>
  </div>
</main>

      
  <?php 
  include '../includes/footer.php';
  ?>

  <script src="../assets/scripts/scripts-secondary.js"></script>
  <script src="../assets/scripts/popup.js"></script>


</body>
</html>
</html>