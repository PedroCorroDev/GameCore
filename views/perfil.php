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

<?php
   $email = filter_input(INPUT_GET, "comprobacionEmail", FILTER_SANITIZE_EMAIL);
   $telefono = filter_input(INPUT_GET, "comprobacionTelefono", FILTER_SANITIZE_NUMBER_INT);
   $comprobacionContrasenya = filter_input(INPUT_GET, "comprobacionContrasenya", FILTER_SANITIZE_NUMBER_INT);
   $comprobaciones = filter_input(INPUT_GET, "comprobaciones", FILTER_SANITIZE_NUMBER_INT);


   $errPerf1 = "Este email ya esta registrado";
   $errPerf2 = "Este telefono ya está asignado a una cuenta";
   $errPerf3 = "Introduce una contraseña diferente a la actual";
   $errPerf4 = "Se han ejecutado los cambios pero no se ha guardado la contraseña";
   $errPerf5 = "No se han ejecutado cambios";

    include "../includes/abrecnx.php";

    if(isset($_SESSION["user"])){
        // Ejecuta consulta SQL
        $sql = "SELECT idUser FROM users_login WHERE usuario='" . $_SESSION["user"] . "'";
        $rs = $mysqli->query($sql);
    
        if ($rs->num_rows > 0){
            $fila = mysqli_fetch_assoc($rs);
            $idUser = $fila["idUser"];
    
            $sql1 = "SELECT * FROM users_data WHERE idUser=" . $idUser;
            $rs1 = $mysqli->query($sql1);
            while($row = $rs1->fetch_assoc()) {
                $datos = array (
                    'nombre' => $row['nombre'],
                    'apellidos' => $row['apellidos'],
                    'email' => $row['email'],
                    'telefono' => $row['telefono'],
                    'fNacimiento' => $row['fNacimiento'],
                    'direccion' => $row['direccion'],
                    'sexo' => $row['sexo']
                );
            }
        } else {
            echo 'Ha habido un error';
        }
    } else {
        echo 'No hay una sesión iniciada';
    }
  




   include "../includes/cierracnx.php";

?>
<section class="contenedor perfil">
  <div class="contenedor-perfil">
    <h1>Perfil</h1>
    <form action="../includes/formulario_perfil.php" method="POST" class="form-perfil">
      <ul>
        <li>
          <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="perfilnombre" value="<?php echo $datos['nombre'];?>" required>
          </div>
        </li>
        <li>
          <div>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="perfilapellidos" value="<?php echo $datos['apellidos']; ?>" >
          </div>
        </li>
        <li>
          <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="perfilemail" value="<?php echo $datos['email']; ?>" required>
          </div>
          <span><?php echo ($email == 1)?$errPerf1:"";?></span>
        </li>
        <li>
          <div>
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="perfiltelefono" value="<?php echo $datos['telefono']; ?>" required>
          </div>
          <span><?php echo ($telefono == 1)?$errPerf2:"";?></span>
        </li>
        <li>
          <div>
            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="perfilfecha_nacimiento" value="<?php echo $datos['fNacimiento']; ?>" required>
          </div>
        </li>
        <li>
          <div>
            <label for="direccion">Dirección:</label>
            <textarea id="direccion" name="perfildireccion"><?php echo $datos['direccion']; ?></textarea>
          </div>
        </li>
        <li>
          <div>
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="perfilsexo">
                <option value=""  <?php if ($datos['sexo'] !== 'Hombre' and $datos['sexo'] !== 'Mujer') { echo 'selected'; } ?> disabled>Selecciona una opción</option>
                <option value="Hombre" <?php if ($datos['sexo'] == 'Hombre') { echo 'selected'; } ?>>Hombre</option>
                <option value="Mujer" <?php if ($datos['sexo'] == 'Mujer') { echo 'selected'; } ?>>Mujer</option>
            </select>
          </div>
        </li>
        <li>
          <div>
            <label for="contrasenya">Contraseña:</label>
            <input type="password" id="contrasenya" name="perfilcontrasenya" placeholder="Escribir contraseña para cambiarla.">
          </div>
          <span><?php echo ($comprobacionContrasenya == 1)?$errPerf3:"";?></span>
          <span><?php echo ($comprobacionContrasenya == 2)?$errPerf4:"";?></span>
          <span><?php echo ($comprobaciones == 1)?$errPerf5:"";?></span>

        </li>
      </ul>
      <div>
        <button type="submit" class="button"> <span class=text>Actualizar</span></button>
      </div>
    </form>
  </div>
</section>


<?php include "../includes/footer.php";?>

<script src="../assets/scripts/scripts-secondary.js"></script>
<script src="../assets/scripts/popup.js"></script>


</body>
</html>
