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

<section class="contenedor">
    <div>
        <h1>Usuarios</h1>
        <div class="users-contenedor">
        <?php
            include "../includes/abrecnx.php";

            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $limit = 5;
            $offset = $page * $limit;

            // Ejecuta consulta SQL
            $sql = "SELECT users_login.idUser, users_login.usuario, users_data.nombre, users_data.email, users_data.telefono FROM users_login INNER JOIN users_data ON users_login.idUser = users_data.idUser ORDER BY idUser ASC LIMIT $offset, $limit";
            $rs = $mysqli->query($sql);

            $users = array();

            if ($rs->num_rows > 0) {
                while($row = $rs->fetch_assoc()) {
                    $user = array(
                        'idUser' => $row['idUser'],
                        'usuario' => $row['usuario'],
                        'nombre' => $row['nombre'],
                        'email' => $row['email'],
                        'telefono' => $row['telefono']
                    );

                    array_push($users, $user);

                    
                }
            } else{
                echo 'No hay usuarios';
            }

            include "../includes/cierracnx.php";

            ?>
            <ul class="user-contenedor">
                <li class="user">
                    <div>
                        <p>Id</p>
                        <p>Usuario</p>
                        <p>Nombre</p>
                        <p>Email</p>
                        <p>Telefono</p>
                    </div>
                    <div></div>
                </li>
                <?php foreach ($users as $user): ?>
                <li class="user">
                    <div>
                        <p><?php echo $user['idUser']; ?></p>
                        <p><?php echo $user['usuario']; ?></p>
                        <p><?php echo $user['nombre']; ?></p>
                        <p><?php echo $user['email']; ?></p>
                        <p><?php echo $user['telefono']; ?></p>
                    </div>
                    <div>
                        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>#formulario-user">
                            <input type="hidden" name="idUserMod<?= $user['idUser'] ?>" value="<?= $user['idUser'] ?>">
                            <button type="submit"><i class="fa-regular fa-pen-to-square" style="color: #093786;"></i></button>
                        </form>     
                        <button onclick="confirmarEliminacionAdmin(<?php echo $user['idUser'];?>)"><i class="fa-regular fa-rectangle-xmark" style="color: #ff0000;"></i></button>             
                    </div>
                    <form method="POST" action="../includes/eliminar_userAdmin.php" id="formularioEliminarUser<?php echo $user['idUser']; ?>">
                            <input type="hidden" name="idUserEliminar<?php echo $user['idUser']; ?>" value="<?php echo $user['idUser']; ?>">
                    </form>  
                </li> 
                     
                <?php endforeach; ?>
            </ul>
            <p>
                <?php
                  $erased = filter_input(INPUT_GET, "erased", FILTER_SANITIZE_NUMBER_INT);
                  $errErase = "No se ha podido eliminar el usuario."; 
                   echo ($erased == 1)?$errErase:"";
                  ?>
            </p>
            <div class="news-buttons">
                <?php 
                    $prevPage = max(0, $page - 1);
                    $nextPage = $page + 1;
                    echo "<form method='get'>";
                    echo "<input type='hidden' name='page' value='$prevPage'>";
                    echo "<button type='submit' class='button'><i class='fas fa-arrow-circle-left' style='color: white; font-size: 20px;'></i></button>";
                    echo "</form>";

                    echo "<form method='get'>";
                    echo "<input type='hidden' name='page' value='$nextPage'>";
                    echo "<button type='submit' class='button'><i class='fas fa-arrow-circle-right' style='color: white; font-size: 20px;'></i></button>";
                    echo "</form>";
                ?>
            </div>
        </div>
    </div>

    <?php 
    $errUser = filter_input(INPUT_GET, "errUser", FILTER_SANITIZE_NUMBER_INT);
                

    $errU0 = "No has modificado ningún campo.";
    $errU1 = "No se ha podido modificar los datos del usuario.";


    ?>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $key => $value) {
              if (strpos($key, 'idUserMod') === 0) {
                
                include '../includes/abrecnx.php';
                $idUserMod = (int) $value;
                
                $sqlMod = "SELECT ud.*, ul.rol FROM users_data ud JOIN users_login ul ON ud.idUser = ul.idUser WHERE ud.idUser ='" . $idUserMod . "'";
                $rsMod = $mysqli->query($sqlMod);
                $rowMod = $rsMod->fetch_assoc(); 
                $userMod = array(
                    'nombre' => $rowMod['nombre'],
                    'apellidos' => $rowMod['apellidos'],
                    'email' => $rowMod['email'],
                    'telefono' => $rowMod['telefono'],
                    'fNacimiento' => $rowMod['fNacimiento'],
                    'direccion' => $rowMod['direccion'],
                    'sexo' => $rowMod['sexo'],
                    'rol' => $rowMod['rol']
                );

                include '../includes/cierracnx.php';
              }
              
            }     
        
          } 
        
    ?>
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

    <div id="formulario-user">
        <h1 id="titulo-formulario-user"></h1>        
        <div class="users-contenedor">
            <form action="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && strpos(array_keys($_POST)[0], 'idUserMod') === 0) ? '../includes/modificar_users.php' : '../includes/validacion_formularioAdmin.php'; ?>" method="POST">             
                <ul>
                    <li>
                        <div>
                            <label for="nombre">Nombre del usuario:</label>
                            <input type="text" name="nombre" id="nombre" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($userMod['nombre'])) ? $userMod['nombre'] : '' ?>" required>
                        </div>
                        <span><?php echo ($nombre == 1)?$err0:"";?></span>

                    </li>
                    <li>
                        <div>
                            <label for="apellidos">Apellidos del usuario:</label>
                            <input type="text" name="apellidos" id="apellidos" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($userMod['apellidos'])) ? $userMod['apellidos'] : '' ?>" required>
                        </div>
                        <span><?php echo ($apellidos == 1)?$err1:"";?></span>

                    </li>
                    <li>
                        <div>
                            <label for="email">Email del usuario:</label>
                            <input type="email" name="email" id="email" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($userMod['email'])) ? $userMod['email'] : '' ?>" required>
                        </div>
                        <span><?php echo ($email == 1)?$err2:"";?></span>

                    </li>
                    <li>
                        <div>
                            <label for="telefono">Telefono del usuario:</label>
                            <input type="tel" name="telefono" id="telefono" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($userMod['telefono'])) ? $userMod['telefono'] : '' ?>" required>
                        </div>
                        <span><?php echo ($telefono == 1)?$err3:"";?></span>

                    </li>
                    <li>
                        <div>
                            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($userMod['fNacimiento'])) ? $userMod['fNacimiento'] : '' ?>" required>
                        </div>
                        <span><?php echo ($fecha_nacimiento == 1)?$err4:"";?></span>
                    </li>
                    <li>
                        <div>
                            <label for="direccion">Direccion del usuario:</label>
                            <input type="text" name="direccion" id="direccion" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($userMod['direccion'])) ? $userMod['direccion'] : '' ?>" >
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="sexo">Sexo:</label>
                            <select id="sexo" name="sexo">
                                <option value=""  <?php if (isset($userMod['sexo'])){if ($userMod['sexo'] !== 'Hombre' and $userMod['sexo'] !== 'Mujer') { echo 'selected'; }}else{echo'selected';}?> disabled>Selecciona una opción</option>
                                <option value="Hombre" <?php if(isset($userMod['sexo'])){if ($userMod['sexo'] == 'Hombre') { echo 'selected'; }} ?>>Hombre</option>
                                <option value="Mujer" <?php if(isset($userMod['sexo'])){if ($userMod['sexo'] == 'Mujer') { echo 'selected'; }} ?>>Mujer</option>
                            </select>
                        </div>
                    </li>
                    <?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && strpos(array_keys($_POST)[0], 'idUserMod') === 0) ? '' : '
                    <li>
                        <div>
                            <label for="usuario">Usuario:</label>
                            <input type="text" id="usuario" name="usuario" placeholder="Escribe tu usuario" value="' . (($usuario == 1) ? "" : $usuario) . '" required>
                        </div>
                        <span>' . (($usuario == 1) ? $err5 : '') . (($userComprobacion == 1) ? $errComp0 : '') . '</span>
                    </li>
                    <li>
                        <div>
                            <label for="contrasenya">Contraseña:</label>
                            <input type="password" id="contrasenya" name="contrasenya" placeholder="Escribe tu contraseña" value="' . (($contrasenya == 1) ? "" : $contrasenya) . '" required>
                        </div>
                        <span>' . (($contrasenya == 1) ? $err6 : '') . '</span>
                    </li>';?>
                    <li><div>
                            <label for="rol">Rol:</label>
                            <select id="rol" name="rol">
                                <option value="user" <?php if(isset($userMod['rol'])){if ($userMod['rol'] == 'user') { echo 'selected'; }} ?>>User</option>
                                <option value="admin" <?php if(isset($userMod['rol'])){if ($userMod['rol'] == 'admin') { echo 'selected'; }} ?>>Admin</option>
                            </select>
                        </div>
                    </li>
                    <input type="hidden" name="idUserMod" value="<?php echo $idUserMod ?>">


                    <span><?php if (isset($_GET['errUser']) && $_GET['errUser'] == 0) { echo $errU0; }if (isset($_GET['errUser']) && $_GET['errUser'] == 1) { echo $errU1; } ?></span>

                </ul>
                <button type="submit" class="button"> <span class="text" id="buttonTextUser"></span></button>
            </form>
            <?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && strpos(array_keys($_POST)[0], 'idUserMod') === 0) ? '
            <form style="margin-top:2rem;"method="POST" action="' . $_SERVER["PHP_SELF"] . '">
                <input type="hidden" name="clear">
                <button type="submit" class="button"> <span class="text" id="buttonTextUser">Nuevo User</span></button>
            </form>' : '';?>
        </div>
    </div>

</section>



<?php 
include '../includes/footer.php';
?>

<script src="../assets/scripts/scripts-secondary.js"></script>
<script src="../assets/scripts/popup.js"></script>
</body>
</html>
