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
    include "../includes/abrecnx.php";

    $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
    $limit = 5;
    $offset = $page * $limit;

    // Ejecuta consulta SQL
    $sql = "SELECT * FROM noticias ORDER BY idNoticia DESC LIMIT  $offset, $limit";
    $rs = $mysqli->query($sql);

    $noticias = array();

    // Itera sobre los rsados
    if ($rs->num_rows > 0) {
    while($row = $rs->fetch_assoc()) {
        // Crea un objeto para cada noticia y guarda las propiedades necesarias
        $noticia = array(
        'idNoticia' => $row['idNoticia'],
        'titulo' => $row['titulo'],
        'texto' => $row['texto'],
        'imagen' => $row['imagen'],
        'fecha' => $row['fecha'],
        'autor' => ''
        );

        // Realiza otra consulta SQL para obtener el nombre del autor
        $sql2 = "SELECT nombre FROM users_data WHERE idUser=" . $row['idUser'];
        $rs2 = $mysqli->query($sql2);

        if ($rs2->num_rows > 0) {
        $row2 = $rs2->fetch_assoc();
        $noticia['autor'] = $row2['nombre'];
        }

        // Agrega la noticia al arreglo de noticias
        array_push($noticias, $noticia);
    }
    } 

   include "../includes/cierracnx.php";

?>

<section class="news-section contenedor">
    <div class="news-admin-title">
        <h1>Noticias</h1>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>#formulario-news">
                <input type="hidden" name="form_newNew">
                <input type="hidden" name="idUserMod<?= $user['idUser'] ?>" value="<?= $user['idUser'] ?>">
                <button type="submit">
                    <i class="fa-solid fa-plus" style="color:white;"></i>
                    <i class="fa-regular fa-newspaper" style="color: white;"></i>
                </button>
        </form>   
    </div>
    <div class="news-admin-contenedor">
        <?php foreach ($noticias as $noticia): ?>
        <article class="new-admin">
            <img src="<?php echo $noticia['imagen']; ?>" alt="Imagen de noticia">
            <div class="new-content">
                <h2><?php echo $noticia['titulo']; ?></h2>
                <div>
                    <span>Escrito por: </span><?php echo $noticia['autor']; ?> | <?php echo $noticia['fecha']; ?>
                </div>
                <p style="text-align: justify;"><?php echo $noticia['texto']; ?></p>
            </div>
            <ul>
                <li>
                    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>#formulario-news">
                        <input type="hidden" name="form_getNew">
                        <input type="hidden" name="idNoticiaModAdmin<?= $noticia['idNoticia'] ?>" value="<?= $noticia['idNoticia'] ?>">
                        <button type="submit"><i class="fa-regular fa-pen-to-square" style="color: #093786;"></i></button>
                    </form>                            
                    <button onclick="confirmarEliminacionNoticia(<?php echo $noticia['idNoticia']?>)"><i class="fa-regular fa-rectangle-xmark" style="color: #ff0000;"></i></button>             
                </li> 
                <form method="POST" action="../includes/eliminar_noticia.php" id="formularioEliminarNoticia<?php echo $noticia['idNoticia']; ?>">
                    <input type="hidden" name="idAdminNoticia<?php echo $noticia['idNoticia']; ?>" value="<?php echo $noticia['idNoticia']; ?>">
                </form>   
            </ul>
        </article>
        <?php   
            $errNew = filter_input(INPUT_GET, "errNew", FILTER_SANITIZE_NUMBER_INT);
            $erasedNoticia = filter_input(INPUT_GET, "erasedNoticia", FILTER_SANITIZE_NUMBER_INT);

            $err4 = "Este título ya existe.";
            $err5 = "No se ha podido borrar la noticia.";
            $err6 = "No se ha modificado ningun dato.";
            $err7 = "No se ha podido actualizar la noticia.";

            if(isset($_GET['title'])){
                $title = $_GET['title'];
                $image = $_GET['image'];
                $body = $_GET['body'];
                $fecha = $_GET['fecha'];
            }
            if(isset($_GET['errImage'])){
                $errImage = $_GET['errImage'];
            }
    
            $err0 = "El titulo no puede estar vacío.";
            $err1 = "La URL de la imagen debe ser válida.";
            $err2 = "El cuerpo debe no puede estar vacío.";
            $err3 = "La fecha no puede estar vacía.";
            $errImg = "La imagen no es correcta.";

          
           
            
        ?>
        <?php endforeach; ?>
        <span style="color: red; padding-bottom: 2rem; font-style: italic; display: grid; place-content: center;";>
            <?php echo ($errNew == 1)?$err4:"";?>
            <?php echo ($erasedNoticia == 1)?$err5:"";?>
            <?php echo ($errNew == 2)?$err6:"";?>
            <?php echo ($errNew == 3)?$err7:"";?>
            <?php if(isset($_GET['title'])){
                echo ($title == 1)?$err0:"";
                echo ($image == 1)?$err1:"";
                echo ($body == 1)?$err2:"";
                echo ($fecha == 1)?$err3:"";
            } ?>
             <?php if(isset($_GET['errImage'])){
                echo ($errImage == 1)?$errImg:"";
           
            } ?>
    
        </span>
       
      
        <div class="news-buttons">
            <?php 
                // Agrega los botones para cambiar de página
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
    
</section>    
    
     <?php //Información con la que rellenaremos el formulario en caso de haber seleccionado una noticia
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getNew'])){
            include '../includes/abrecnx.php';
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'idNoticiaModAdmin') === 0) {     
                    $idNoticiaMod = (int) $value;   
                    $sqlNoticiaToMod = "SELECT * FROM noticias WHERE idNoticia ='" . $idNoticiaMod . "'";
                    $rsNoticiaToMod = $mysqli->query($sqlNoticiaToMod);
                    if ($rsNoticiaToMod->num_rows > 0) { 
                    $rowNoticiaToMod = $rsNoticiaToMod->fetch_assoc(); 
                        if ($rsNoticiaToMod){
                            $noticiaToMod = array(
                                'idNoticia' => $rowNoticiaToMod['idNoticia'],
                                'titulo' => $rowNoticiaToMod['titulo'],
                                'imagen' => $rowNoticiaToMod['imagen'],
                                'texto' => $rowNoticiaToMod['texto'],
                                'fecha' => $rowNoticiaToMod['fecha'],
                                'idUser' => $rowNoticiaToMod['idUser']
                            );
                        }
                    }
                }
            }     
            include '../includes/cierracnx.php';
        }
    ?>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <article id="formulario-news"class="contenedor">
        <h1><?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getNew'])) {echo 'Modificar Noticia';} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_newNew'])) {echo 'Nueva noticia';}?></h1>        
        <div class="users-contenedor">
            <form action="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getNew'])) {echo '../includes/modificar_newAdmin.php';} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_newNew'])) {echo '../includes/form_newsAdmin.php';}?>" method="POST">                
                <ul>
                    <li>
                        <div>
                            <label for="title">Título: </label>
                            <input type="text" name="title" id="title" placeholder="Escribe el título de la notícia" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getNew'])) ? $noticiaToMod['titulo'] : '' ?>" required>
                        </div>
                        <span></span>

                    </li>
                    <li>
                        <div>
                            <label for="image">Imagen: </label>
                            <input type="text" name="image" id="image" placeholder="Escribe el url de la notícia" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getNew'])) ? $noticiaToMod['imagen'] : '' ?>" required>
                        </div>
                        <span></span>

                    </li>
                    <li>
                        <div>
                            <label for="body">Cuerpo:</label>
                            <textarea name="body" id="body" placeholder="Escribe el cuerpo de la noticia" required><?php 
                            echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getNew'])) ? $noticiaToMod['texto'] : ''
                            ?></textarea>
                            <span></span>

                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="fecha">Fecha de la noticia: </label>
                            <input type="date" name="fecha" id="fecha" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getNew'])) ? $noticiaToMod['fecha'] : '' ?>" required>
                        </div>
                        <span></span>
                    </li>
                    <li>
                        <div>
                            <input type="hidden" name="autor" id="autor" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_getNew'])) ? $noticiaToMod['idUser'] : '' ?>">
                        </div>
                    </li>
                    <input type="hidden" name="idUserCitaTo" value="<?php echo $idUserCitas; ?>">
                 
                    <input type="hidden" name="idNewToMod" value="<?php echo $noticiaToMod['idNoticia']; ?>">

                </ul>
                <button type="submit" class="button"> <span class="text" id="buttonText">Enviar</span></button>
            </form>
        </div>
    </article>
    <?php endif; ?>

<?php include "../includes/footer.php"; ?>


<script src="../assets/scripts/popup.js"></script>

</body>
</html>