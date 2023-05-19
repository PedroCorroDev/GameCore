<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Core</title>
    <script src="https://kit.fontawesome.com/926d45081f.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.png">
    <link rel="stylesheet" href="./assets/css/normalize.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Marko+One&family=Pacifico&display=swap" rel="stylesheet">    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
 
</head>
<body>   
    
    <header class="site-header hero">
        <!--Barra de Navegación-->
       
       <div class="barra contenedor relative" id="navbar"> 
            <div class="menu-barra">
                <a href="#"> <span class="nombrelogo">GameCore</span> </a>
                <div class="minimenu"> <!--Caja para la apertura y cierre de la barra de navegación en versión móvil-->
                    <a href="#nav">
                        <i class="fa-solid fa-bars"></i>  <!--Objeto para abrir el menú de móvil-->
                    </a> 
                </div>
            </div>
            <nav class="barra nav" id="nav">                 
                <a href="#" class="actual-page"> 
                    Inicio
                </a>
                <a href="./views/noticias.php">
                   Noticias
                </a>
                <?php 
                session_start();
                if(@$_SESSION["valido"] == "SI"){ //Si no está la sesión iniciada, nos lleva al logeo 
                    if (@$_SESSION["rol"] == "user"){
                        echo '<a href="./views/citas.php">
                                Citas 
                            </a>';
                        echo '<a href="./views/perfil.php">
                            Perfil 
                        </a>';    
                        echo '<form action="./includes/salir_sesion.php" method="post">
                            <button type="submit" name="close" value="" class="off-button"><i class="fa-solid fa-power-off" style="color: rgb(17,17,17);"></i></button>
                        </form>';
                    }
                    if (@$_SESSION["rol"] == "admin"){
                        echo '<a class="btn" id="boton_administracion" onclick="expandirAdmin()">
                        Administración
                    </a>';
                        echo '<a href="./views/perfil.php">
                            Perfil 
                        </a>';
                        echo '<form action="./includes/salir_sesion.php" method="post">
                            <button type="submit" name="close" value="" class="off-button"><i class="fa-solid fa-power-off" style="color: rgb(17,17,17);"></i></button>
                        </form>';    
                    }
                    
                }else{
                    echo '<a href="./views/registro.php">
                            Registro
                        </a>';
                }

                ?>
                <a href="#" class="cruz">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </nav>
        </div>
        <div>
            <div class="contenido-header" id="contenido-header">
                <h1 id="titulo-header">
                    
                </h1>
                <span id="descripcion-header" class="text">

                </span>
                <button class="sparkle-button button">
                    <span class="spark"></span>
                    <!-- <span class="spark"></span> -->
                    <span class=backdrop></span>
                       <a class="text" href="#" id="botonHero">Ver más</a>
                  </button>
            </div>
            <aside>

            </aside>
        </div>
    </header>
    <main class="contenedor seccion">

        <?php
            include "./includes/abrecnx.php";

            // Ejecuta consulta SQL
            $sql1 = "SELECT * FROM noticias ORDER BY idNoticia DESC LIMIT 1";
            $rs1 = $mysqli->query($sql1);

            $noticias1 = array();

            // Itera sobre los resultados
            if ($rs1->num_rows > 0) {
                while(($row1 = $rs1->fetch_assoc()) ) {
                    // Crea un objeto para cada noticia y guarda las propiedades necesarias
                    $noticia1 = array(
                        'titulo' => $row1['titulo'],
                        'texto' => $row1['texto'],
                        'imagen' => $row1['imagen'],
                        'fecha' => $row1['fecha'],
                        'autor' => ''
                    );

                    // Realiza otra consulta SQL para obtener el nombre del autor
                    $sql3 = "SELECT nombre FROM users_data WHERE idUser=" . $row1['idUser'];
                    $rs3 = $mysqli->query($sql3);

                    if ($rs3->num_rows > 0) {
                        $row3 = $rs3->fetch_assoc();
                        $noticia1['autor'] = $row3['nombre'];
                    }

                    // Agrega la noticia al arreglo de noticias
                    array_push($noticias1, $noticia1);

                
                }
            }

            include "./includes/cierracnx.php";
        ?>        


        <h1>¿Qué hay de nuevo?</h1>
        <div class="noticias"> <!--Div que carga noticias -->
            <article class="noticia-principal" style="background: linear-gradient(rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.2) 10%,rgba(0,0,0,0) 15%,rgba(0,0,0,0) 80%, rgba(0,0,0,0.4) 90%, rgba(0,0,0,0.8) 100%), url(<?php echo $noticia1['imagen']; ?>)" >
                <h2><?php echo $noticia1['titulo']; ?></h2>
            </article>


            <?php
                include "./includes/abrecnx.php";

                // Ejecuta consulta SQL
                $sql = "SELECT * FROM noticias ORDER BY idNoticia DESC LIMIT 5";
                $rs = $mysqli->query($sql);

                $noticias = array();

                // Itera sobre los resultados
                if ($rs->num_rows > 0) {
                    while(($row = $rs->fetch_assoc()) ) {
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

                    // Seleccionar las últimas 4 noticias y revertir el orden
                    $noticias = array_slice($noticias, 1);
                }

                include "./includes/cierracnx.php";
            ?>

                <aside class="noticia-secundaria">
                    <?php foreach ($noticias as $noticia): ?>
                        <div class="noticia" >
                            <h3><?php echo $noticia['titulo']; ?></h3>
                            <h4><?php echo $noticia['autor']; ?></h4>
                            <div class="noticia-imagen" style="background: url(<?php echo $noticia['imagen']; ?>); background-size: cover; background-repeat: no-repeat; background-position: center; clip-path: polygon(100% 100%, 100% 0%, 75% 0%, 60% 100%);"></div>
                        </div>
                    <?php endforeach; ?>
                </aside>        
        </div>
    </main>

    <section class="seccion seccion-secundaria" id="seccion1">
        <div class="contenedor"><h1>Dispositivos</h1></div>
        <div class="slider contenedor">
            <div id="sliderGames"></div>
            <article>  
                <div class="descripcionGames">
                    <h2>¡Los dispositivos más top en GameCore!</h2>
                    <p>Disponemos de gran variedad en consolas y dispositivos. Además, amplia selección de los mejores videojuegos.</p>
                   <a href="<?php if(@$_SESSION["valido"] == "SI"){ //Si no está la sesión iniciada, nos lleva al logeo 
                    echo "./views/citas.php";}else{ echo "./views/registro.php";}?>"> 
                        <button class="sparkle-button button">                   
                            <span class=text>Reserva</span>
                        </button>
                    </a>
                    
                </div>        
                <div class="barraControladores">
                    <div id="circleSlider"></div>
                </div>              
            </article>
        </div>
    </section>
    <section class="contenedor seccion seccion-secundaria" id="seccion2">
        <h1>Esports</h1>
        <div class="esports"> 
            <div class="carta-entretenimiento" id="poster1"></div>
            <div class="carta-entretenimiento" id="poster2"></div>
            <div class="carta-entretenimiento" id="poster3"></div>
        </div>
    </section>

    <section class="contenedor seccion seccion-secundaria" id="seccion3">
        <h1>Entretenimiento</h1>
        <div class="entretenimiento"> 
            <div class="carta-entretenimiento" id="poster4"></div>
            <div class="carta-entretenimiento" id="poster5"></div>
            <div class="carta-entretenimiento" id="poster6"></div>
        </div>
    </section>
   


     <?php   
     include 'includes/footer.php';
     ?>

<script src="./assets/scripts/scripts.js"></script>
    <script src="./assets/scripts/libreria-dinamica.js"></script>

</body>
</html>