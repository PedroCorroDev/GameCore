<a href="<?= strpos($_SERVER['REQUEST_URI'], 'index') !== false ? './' : '../' ?>index.php" id="index"> 
    Inicio
</a>
<a href="<?= strpos($_SERVER['REQUEST_URI'], 'index') !== false ? './views/' : './' ?>noticias.php" id="noticias">
    Noticias
</a>
<?php 
session_start();
if(@$_SESSION["valido"] == "SI"){ //Si no está la sesión iniciada, nos lleva al logeo (Yo he puesto un segundo igual, en la clase solo habia uno)
    if (@$_SESSION["rol"] == "user"){
        echo '<a href="'. (strpos($_SERVER['REQUEST_URI'], 'index') !== false ? './views/' : './') .  'citas.php" id="citas">
                Citas 
            </a>';
        echo '<a href="'. (strpos($_SERVER['REQUEST_URI'], 'index') !== false ? './views/' : './') .  'perfil.php"  id="perfil">
            Perfil 
        </a>';    
        echo '<form action="../includes/salir_sesion.php" method="post">
        <button type="submit" name="close" value="" class="off-button"><i class="fa-solid fa-power-off" style="color: rgb(17,17,17);"></i></button>
      </form>';
    }
    if (@$_SESSION["rol"] == "admin"){
        echo '<a class="btn" id="boton_administracion" onclick="expandirAdmin()">
                Administración
            </a>';
        echo '<a href="' . (strpos($_SERVER['REQUEST_URI'], 'index') !== false ? './views/' : './') . 'perfil.php" id="perfil">
            Perfil 
        </a>';    
        echo '<form action="../includes/salir_sesion.php" method="post">
        <button type="submit" name="close" value="" class="off-button"><i class="fa-solid fa-power-off" style="color: rgb(17,17,17);"></i></button>
      </form>';
    }
    
}else{
    echo '<a href="' . (strpos($_SERVER['REQUEST_URI'], 'index') !== false ? './views/' : './') . 'registro.php" id="registro">
            Registro
        </a>';
}

?>

<a href="#" class="cruz">
    <i class="fa-solid fa-xmark cruz"></i> <!--Objeto para cerrar el menú de móvil-->
</a>