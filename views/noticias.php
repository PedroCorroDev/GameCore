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

<div class="news-section contenedor">
    <?php foreach ($noticias as $noticia): ?>
        <article class="new">
            <img src="<?php echo $noticia['imagen']; ?>" alt="Imagen de noticia">
            <div class="new-content">
                <h2><?php echo $noticia['titulo']; ?></h2>
                <div>
                    <span>Escrito por: </span><?php echo $noticia['autor']; ?> | <?php echo $noticia['fecha']; ?>
                </div>
                <p style="text-align: justify;"><?php echo $noticia['texto']; ?></p>
            </div>
    </article>
    <?php endforeach; ?>
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

<?php include "../includes/footer.php"; ?>


<script src="../assets/scripts/popup.js"></script>



</body>
</html>
