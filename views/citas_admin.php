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
    <article>
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

            // Itera sobre los resultados
            if ($rs->num_rows > 0) {
                while($row = $rs->fetch_assoc()) {
                    // Crea un objeto para cada usuario y guarda las propiedades necesarias
                    $user = array(
                        'idUser' => $row['idUser'],
                        'usuario' => $row['usuario'],
                        'nombre' => $row['nombre'],
                        'email' => $row['email'],
                        'telefono' => $row['telefono']
                    );
                    // Agrega el usuario al arreglo de usuarios
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
                            <input type="hidden" name="form_getUser">
                            <input type="hidden" name="idUserMod<?= $user['idUser'] ?>" value="<?= $user['idUser'] ?>">
                            <button type="submit"><i class="fa-regular fa-user" style="color: #093786;"></i></button>
                        </form>     
                    </div>                    
                </li> 
                     
                <?php endforeach; ?>
            </ul>
            
            <?php  // Conjunto de errores que se mostrarán en caso de que se produzcan
                $errCita = filter_input(INPUT_GET, "errCita", FILTER_SANITIZE_NUMBER_INT);
                $errC1 = "El usuario ha ocupado el límite de citas.";
                $errC2 = "La fecha escogida ya ha vencido.";
                $errC3 = "Debes modificar los campos.";
                $errC4 = "No se ha podido modificar la cita.";
            ?>
            <span style="margin: 0 auto 2rem auto; color: red; font-style: italic":>
                <?php echo ($errCita == 1)?$errC1:"";?>
                <?php echo ($errCita == 2)?$errC2:"";?>
                <?php echo ($errCita == 3)?$errC3:"";?>
                <?php echo ($errCita == 4)?$errC4:"";?>
            </span>

          
            <div class="news-buttons">
                <?php // Botones para cambiar de página
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
    </article>





    <?php  //Declaracion de errores que serán utilizados a futuro
        $errUser = filter_input(INPUT_GET, "errUser", FILTER_SANITIZE_NUMBER_INT);         
        $errU0 = "No has modificado ningún campo.";
        $errU1 = "No se ha podido modificar los datos del usuario.";
    ?>

    <?php // Creación de array de cita de la base de datos para crear objetos "cita"
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getUser'])) {
            include '../includes/abrecnx.php';
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'idUserMod') === 0) {     
                
                    $idUserCitas = (int) $value;
                    $sqlGetName = "SELECT usuario FROM users_login WHERE idUser ='" . $idUserCitas . "'";
                    $rsGetName = $mysqli->query($sqlGetName);
                    $rowGetName = $rsGetName->fetch_array();


                    $userCitas = array();
                
                    $sqlCitasMod = "SELECT * FROM citas WHERE idUser ='" . $idUserCitas . "'";
                    $rsCitasMod = $mysqli->query($sqlCitasMod);
                    if ($rsCitasMod->num_rows > 0) { 
                        while($rowCitasMod = $rsCitasMod->fetch_assoc()) { 
                            if ($rsCitasMod){
                                $userCita = array(
                                    'idUser' => $rowCitasMod['idUser'],
                                    'idCita' => $rowCitasMod['idCita'],
                                    'fecha_cita' => $rowCitasMod['fecha_cita'],
                                    'motivo_cita' => $rowCitasMod['motivo_cita']
                                );
                                array_push($userCitas, $userCita);
                            }
                        }
                    }
                }
            }     
            include '../includes/cierracnx.php';
        }
    ?>
   
    <article id="formulario-user">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getUser'])): ?>
        <h1>Citas de <?php echo $rowGetName['usuario']; ?></h1>        
        <div class="users-contenedor">
            <ul class="cita-contenedor">
                <?php if ($rsCitasMod->num_rows == 0) { // Si no hay citas programadas
                    echo 'El usuario no tiene citas programadas';
                } else { // Si hay citas programadas
                    foreach ($userCitas as $userCita): ?>
                        <li class="cita">
                            <div>
                                <p><?php echo $userCita['fecha_cita']; ?></p>
                                <p><?php echo $userCita['motivo_cita']; ?></p>
                            </div>
                            <div>
                                <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>#formulario-user-cita">
                                    <input type="hidden" name="form_getCita">
                                    <input type="hidden" name="idCitaModAdmin<?= $userCita['idCita'] ?>" value="<?= $userCita['idCita'] ?>">
                                    <button type="submit"><i class="fa-regular fa-pen-to-square" style="color: #093786;"></i></button>
                                </form>                            
                                <button onclick="confirmarEliminacionCitaAdmin(<?php echo $userCita['idCita']?>)"><i class="fa-regular fa-rectangle-xmark" style="color: #ff0000;"></i></button>             
                            </div>
                        </li> 
                        <form method="POST" action="../includes/eliminar_citaAdmin.php" id="formularioEliminarCitaAdmin<?php echo $userCita['idCita']; ?>">
                            <input type="hidden" name="idAdminCita<?php echo $userCita['idCita']; ?>" value="<?php echo $userCita['idCita']; ?>">
                        </form>   
                    <?php endforeach; 
                } ?>
            </ul>
            <p>
                <?php //Error de borrado
                  $erasedCitaAdmin = filter_input(INPUT_GET, "erasedCitaAdmin", FILTER_SANITIZE_NUMBER_INT);
                  $errErase = "No se ha podido eliminar la cita."; 
                   echo ($erasedCitaAdmin == 1)?$errErase:"";
                  ?>
            </p>
        </div>
        <?php endif; ?>



        <?php //Creacion de objetos cita para recoger la información para su modificación
            //Se crea porque sino al elergir cita la primera vez, desaparece el arreglo de citas y no se puede cambiar a otra
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getCita'])) {
                include '../includes/abrecnx.php';
                foreach ($_POST as $key => $value) {
                    if (strpos($key, 'idCitaModAdmin') === 0) {     
                    
                        $idUserCitas = (int) $value;
                        $sqlGetName = "SELECT users_login.usuario FROM users_login INNER JOIN citas ON users_login.idUser = citas.idUser WHERE citas.idCita ='". $idUserCitas ."'";
                        $rsGetName = $mysqli->query($sqlGetName);
                        $rowGetName = $rsGetName->fetch_array();


                        $userCitas = array();
                    
                        $sqlCitasMod = "SELECT * FROM citas WHERE idUser = (SELECT idUser FROM citas WHERE idCita ='" . $idUserCitas . "')";
                        $rsCitasMod = $mysqli->query($sqlCitasMod);
                        if ($rsCitasMod->num_rows > 0) { 
                            while($rowCitasMod = $rsCitasMod->fetch_assoc()) { 
                                if ($rsCitasMod){
                                    $userCita = array(
                                        'idUser' => $rowCitasMod['idUser'],
                                        'idCita' => $rowCitasMod['idCita'],
                                        'fecha_cita' => $rowCitasMod['fecha_cita'],
                                        'motivo_cita' => $rowCitasMod['motivo_cita']
                                    );
                                    array_push($userCitas, $userCita);
                                }
                            }
                        }
                    }
                }     
                include '../includes/cierracnx.php';
            }
        ?>

        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getCita'])): ?>
        <h1>Citas de <?php echo $rowGetName['usuario']; ?></h1>        
        <div class="users-contenedor">
            <ul class="cita-contenedor">
                <?php if ($rsCitasMod->num_rows == 0) { // Si no hay citas programadas
                    echo 'El usuario no tiene citas programadas';
                } else { // Si hay citas programadas
                    foreach ($userCitas as $userCita): ?>
                        <li class="cita">
                            <div>
                                <p><?php echo $userCita['fecha_cita']; ?></p>
                                <p><?php echo $userCita['motivo_cita']; ?></p>
                            </div>
                            <div>
                                <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>#formulario-user-cita">
                                    <input type="hidden" name="form_getCita">
                                    <input type="hidden" name="idCitaModAdmin<?= $userCita['idCita'] ?>" value="<?= $userCita['idCita'] ?>">
                                    <button type="submit"><i class="fa-regular fa-pen-to-square" style="color: #093786;"></i></button>
                                </form>                            
                                <button onclick="confirmarEliminacionCitaAdmin(<?php echo $userCita['idCita']?>)"><i class="fa-regular fa-rectangle-xmark" style="color: #ff0000;"></i></button>             
                            </div>
                        </li> 
                        <form method="POST" action="../includes/eliminar_citaAdmin.php" id="formularioEliminarCitaAdmin<?php echo $userCita['idCita']; ?>">
                            <input type="hidden" name="idAdminCita<?php echo $userCita['idCita']; ?>" value="<?php echo $userCita['idCita']; ?>">
                        </form>   
                    <?php endforeach; 
                } ?>
            </ul>
            <p>
                <?php
                  $erasedCitaAdmin = filter_input(INPUT_GET, "erasedCitaAdmin", FILTER_SANITIZE_NUMBER_INT);
                  $errErase = "No se ha podido eliminar la cita."; 
                   echo ($erasedCitaAdmin == 1)?$errErase:"";
                  ?>
            </p>
        </div>
        <?php endif; ?>
    </article>

    <?php //Información con la que rellenaremos el formulario en caso de haber seleccionado una cita
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getCita'])){
            include '../includes/abrecnx.php';
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'idCitaModAdmin') === 0) {     
                    $idUserCitaMod = (int) $value;   
                    $sqlCitaToMod = "SELECT * FROM citas WHERE idCita ='" . $idUserCitaMod . "'";
                    $rsCitaToMod = $mysqli->query($sqlCitaToMod);
                    if ($rsCitaToMod->num_rows > 0) { 
                    $rowCitaToMod = $rsCitaToMod->fetch_assoc(); 
                    if ($rsCitaToMod){
                        $userCitaToMod = array(
                            'idCita' => $rowCitaToMod['idCita'],
                            'fecha_cita' => $rowCitaToMod['fecha_cita'],
                            'motivo_cita' => $rowCitaToMod['motivo_cita'],
                            'idUser' => $rowCitaToMod['idUser']
                        );
                    }
                    }
                }
            }     
            include '../includes/cierracnx.php';
        }
    ?>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <article id="formulario-user-cita">
        <h1><?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getUser'])) {echo 'Nueva Cita';} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getCita'])) {echo 'Modificar Cita';}?></h1>        
        <div class="users-contenedor">
            <form action="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getUser'])) {echo '../includes/formulario_citaAdmin.php';} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getCita'])) {echo '../includes/modificar_citaAdmin.php';}?>" method="POST">                
                <ul>
                    <li>
                        <div>
                            <label for="fecha">Fecha de la cita: </label>
                            <input type="date" name="fecha" id="fecha" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($userCitaToMod['fecha_cita'])) ? $userCitaToMod['fecha_cita'] : '' ?>" required>
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="motivo">Motivo de la cita:</label>
                            <textarea name="motivo" id="" placeholder="Escribe el motivo de tu cita" required><?php 
                            echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($userCitaToMod['motivo_cita'])) ? $userCitaToMod['motivo_cita'] : ''
                            ?></textarea>
                        </div>
                    </li>
                    <input type="hidden" name="idUserCitaTo" value="<?php echo $idUserCitas; ?>">
                    <?php foreach ($_POST as $name => $value) {
                        if (strpos($name, 'idCitaModAdmin') === 0) {
                            // Extraemos el número que sigue a "idAdminCita"
                            $num = substr($name, strlen('idCitaModAdmin'));
                            // Comprobamos que sea un número válido
                            if (is_numeric($num)) {
                                $idCita = $value;
                                break;
                            }
                        }
                    }?>
                    <input type="hidden" name="idCitaModAdmin" value="<?php echo $idCita; ?>">
                </ul>
                <button type="submit" class="button"> <span class="text" id="buttonText">Reservar</span></button>
            </form>
        </div>
    </article>
    <?php endif; ?>
</section>



<?php 
include '../includes/footer.php';
?>

<script src="../assets/scripts/scripts-secondary.js"></script>
<script src="../assets/scripts/popup.js"></script>
</body>
</html>