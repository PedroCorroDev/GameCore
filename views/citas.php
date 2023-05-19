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
        <h1>Próximas citas</h1>
        <div class="citas-contenedor">
        <?php
            include "../includes/abrecnx.php";

            // Ejecuta consulta SQL, itera sobre los resultados
            // Crea un objeto para cada cita y guarda las propiedades necesarias
            // Agrega la cita al arreglo de citas

            $sql = "SELECT * FROM citas WHERE idUser ='" . $_SESSION['userId'] . "'";
            $rs = $mysqli->query($sql);

            $citas = array();
            if ($rs->num_rows > 0) {
                while($row = $rs->fetch_assoc()) {
                    $cita = array(
                    'idCita' => $row['idCita'],
                    'fecha_cita' => $row['fecha_cita'],
                    'motivo_cita' => $row['motivo_cita'],
                    );
                    array_push($citas, $cita);

                    
                }
            } else{
                echo 'No hay citas programadas';
            }

            include "../includes/cierracnx.php";

            ?>
            <ul class="cita-contenedor">
                <?php foreach ($citas as $cita): //Recorremos el arreglo de citas para mostrar todas las citas?>
                    <li class="cita">
                        <div>
                            <p><?php echo $cita['fecha_cita']; ?></p>
                            <p><?php echo $cita['motivo_cita']; ?></p>
                        </div>
                        <div>
                            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>#formulario-seccion">
                                <input type="hidden" name="idCitaMod<?= $cita['idCita'] ?>" value="<?= $cita['idCita'] ?>">
                                <button type="submit"><i class="fa-regular fa-pen-to-square" style="color: #093786;"></i></button>
                            </form>                            
                            <button onclick="confirmarEliminacion(<?php echo $cita['idCita']?>)"><i class="fa-regular fa-rectangle-xmark" style="color: #ff0000;"></i></button>             
                        </div>
                    </li> 
                    <form method="POST" action="../includes/eliminar_cita.php" id="formularioEliminarCita<?php echo $cita['idCita']; ?>">
                        <input type="hidden" name="idCita<?php echo $cita['idCita']; ?>" value="<?php echo $cita['idCita']; ?>">
                    </form>   
                <?php endforeach; ?>
            </ul>
            <p>
                <?php
                  $erased = filter_input(INPUT_GET, "erased", FILTER_SANITIZE_NUMBER_INT);
                  $errErase = "No se ha podido eliminar la cita."; 
                   echo ($erased == 1)?$errErase:"";
                  ?>
            </p>
        </div>
    </div>

    <?php 
    $errCita = filter_input(INPUT_GET, "errCita", FILTER_SANITIZE_NUMBER_INT);
                

    $errC1 = "Has ocupado el límite de citas.";
    $errC2 = "La fecha escogida ya ha vencido.";
    $errC3 = "Debes modificar los campos.";
    $errC4 = "No se ha podido modificar la cita.";


    ?>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $key => $value) {
              if (strpos($key, 'idCitaMod') === 0) {
                
                include '../includes/abrecnx.php';
                $idCitaMod = (int) $value;
                
                $sqlMod = "SELECT * FROM citas WHERE idCita =" . $idCitaMod;
                $rsMod = $mysqli->query($sqlMod);
                $rowMod = $rsMod->fetch_assoc(); 
                $citaMod = array(
                'fecha_cita' => $rowMod['fecha_cita'],
                'motivo_cita' => $rowMod['motivo_cita'],
                );

              }
              
            }     
        
          } else{ echo '';}
        
    ?>

    <div id="formulario-seccion">
        <h1 id="titulo-formulario"></h1>        
        <div class="citas-contenedor">
            <form action="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && strpos(array_keys($_POST)[0], 'idCitaMod') === 0) ? '../includes/formulario_modificar.php' : '../includes/formulario_cita.php'; ?>" method="POST">             
                <ul>
                    <li>
                        <label for="fecha">Fecha de la cita:</label>
                        <input type="date" name="fecha" id="fecha" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($citaMod['fecha_cita'])) ? $citaMod['fecha_cita'] : '' ?>" required>
                    </li>
                    <li>
                        <label for="motivo">Motivo de la cita:</label>
                        <textarea name="motivo" id="" placeholder="Escribe el motivo de tu cita" required><?php 
                        echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($citaMod['motivo_cita'])) ? $citaMod['motivo_cita'] : ''
                        ?></textarea>
                    </li>
                    <input type="hidden" name="idCitaModif" value="<?php echo $idCitaMod ?>">


                    <span><?php echo ($errCita == 1)?$errC1:"";?></span>
                    <span><?php echo ($errCita == 2)?$errC2:"";?></span>
                    <span><?php echo ($errCita == 3)?$errC3:"";?></span>
                    <span><?php echo ($errCita == 4)?$errC3:"";?></span>



                </ul>
                <button type="submit" class="button"> <span class="text" id="buttonText">Reservar</span></button>
            </form>
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
