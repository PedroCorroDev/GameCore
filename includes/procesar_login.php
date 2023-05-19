<?php

   // Incluye el archivo abrecnx.php que contiene las credenciales de la base de datos y realiza la conexión.
   include "abrecnx.php";

   // Obtiene los datos de usuario y contraseña ingresados en el formulario de inicio de sesión, y los filtra para evitar inyecciones SQL
    $user =filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $pass = $_POST["password"];
  


    $sql = "SELECT idUser, usuario, contrasenya, rol FROM users_login "; 
    $sql .= "WHERE usuario ='" . $user ."'";

    $rs= $mysqli->query($sql);

    if ($rs -> num_rows > 0){
        $fila = mysqli_fetch_assoc($rs);
        $passwordHash = $fila["contrasenya"];
        if(password_verify($pass, $passwordHash)){
            session_start();             // Crea variables de sesión para guardar información del usuario que inició sesión.
            $_SESSION["valido"] = 'SI';
            $_SESSION["userId"] = $fila["idUser"];
            $_SESSION["user"] = $fila["usuario"];
            $_SESSION["password"] = $fila["contrasenya"];
            $_SESSION["rol"] = $fila["rol"];
             // Redirecciona al usuario a la página de registro con un mensaje indicando que inició sesión correctamente.
            header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/registro.php?logged=1");
        }else{
            header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/registro.php?logged=0");
        
        }
            
        
    }else{
        header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/registro.php?logged=0");

    }
    include "cierracnx.php";
    
?>