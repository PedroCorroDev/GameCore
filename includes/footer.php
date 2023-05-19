
<div id="recursos_administracion" class="menu">
    <nav  id="nav2" class="submenu">
        <a href="<?= strpos($_SERVER['REQUEST_URI'], 'index') !== false ? './views/' : './' ?>usuarios_admin.php" id="usuarios_admin"> 
            Usuarios
        </a>
        <a href="<?= strpos($_SERVER['REQUEST_URI'], 'index') !== false ? './views/' : './' ?>citas_admin.php" id="citas_admin"> 
            Citas
        </a>
        <a href="<?= strpos($_SERVER['REQUEST_URI'], 'index') !== false ? './views/' : './' ?>noticias_admin.php" id="noticias_admin"> 
            Noticias
        </a>
        <a href="#" id="closeAdmin">
                <i class="fa-solid fa-xmark"></i> <!--Objeto para cerrar el menú de administración-->
        </a>
    </nav>
</div>

<footer>
        <div class="logos-footer">
            <a href="#">
                <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="#">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="#">
                <i class="fa-brands fa-facebook-f"></i>
            </a>  
        </div>
       
        <div>
            <p>
                <span> C:// San Miguel, nº 34</span>
                <span> 12550, Almazora</span>
                <span>Castellón, Comunidad Valenciana, España</span>
            </p>
        </div>
        <span> &#169; Pedro Corro</span>
    </footer>
