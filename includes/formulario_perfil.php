<?php
include 'abrecnx.php';

$perfilnombre = filter_input(INPUT_POST, "perfilnombre", FILTER_SANITIZE_STRING);
$perfilapellidos = filter_input(INPUT_POST, "perfilapellidos", FILTER_SANITIZE_STRING);
$perfilemail = filter_input(INPUT_POST, "perfilemail", FILTER_SANITIZE_EMAIL);
$perfiltelefono = filter_input(INPUT_POST, "perfiltelefono", FILTER_SANITIZE_NUMBER_INT);
$perfilfecha_nacimiento = filter_input(INPUT_POST, "perfilfecha_nacimiento", FILTER_SANITIZE_STRING);
$perfildireccion = filter_input(INPUT_POST, "perfildireccion", FILTER_SANITIZE_STRING);
$perfilsexo = filter_input(INPUT_POST, "perfilsexo", FILTER_SANITIZE_STRING);
$perfilcontrasenya = filter_input(INPUT_POST, "perfilcontrasenya", FILTER_SANITIZE_STRING);


// Variables para comprobar si el email y/o el teléfono ya están en uso por otro usuario

$comprobacionEmail = false;
$comprobacionTelefono = false;


session_start();



// Consulta para comprobar si el email o teléfono ya están en uso por otro usuario
$comprobacionSQL1 = "SELECT email, telefono FROM users_data WHERE (email = '$perfilemail' OR telefono = '$perfiltelefono') AND idUser <> '{$_SESSION['userId']}'";
$comprob1 = mysqli_query($mysqli, $comprobacionSQL1);
while ($fila = mysqli_fetch_array($comprob1)){
    if ($fila['email'] == $perfilemail){
        $comprobacionEmail = true;
    }else {
        $comprobacionEmail = false;
     }
    if ($fila['telefono'] == $perfiltelefono){
        $comprobacionTelefono = true;
    }else {
        $comprobacionTelefono = false;
     }
}

// Si hay algún error, redirige a la página de perfil con los errores correspondientes
if ($comprobacionEmail == true || $comprobacionTelefono == true){ //Si hay algun fallo, se muestra por pantalla
    header("Refresh:0;url=../views/perfil.php?comprobacionEmail=".$comprobacionEmail."&comprobacionTelefono=".$comprobacionTelefono);
}else{    // Consulta para obtener los datos actuales del usuario
    $sql1 = "SELECT * FROM users_data WHERE idUser ='" . $_SESSION['userId'] . "'";
    $rs1 = $mysqli->query($sql1);
    $row1 = $rs1->fetch_assoc();
    //Comprobacion de diferencia de campos y actualización
    if ($row1['nombre'] !== $perfilnombre || $row1['apellidos'] !== $perfilapellidos || $row1['email'] !== $perfilemail || $row1['telefono'] !== $perfiltelefono || $row1['fNacimiento'] !== $perfilfecha_nacimiento || $row1['direccion'] !== $perfildireccion || $row1['sexo'] !== $perfilsexo){
        $sql2 = "UPDATE users_data SET nombre = '$perfilnombre'";
        $sql2 .= ", apellidos = '$perfilapellidos', email = '$perfilemail', telefono = '$perfiltelefono'";
        $sql2.= ", fNacimiento = '$perfilfecha_nacimiento', direccion = '$perfildireccion', sexo = '$perfilsexo'";
        $sql2.= " WHERE idUser =" . $_SESSION['userId'];
        $rs2 = $mysqli->query($sql2);
    } 
    
    //Comprobacion de contraseña y actualización
    if ($perfilcontrasenya !== ""){
        $sql3 = "SELECT contrasenya FROM users_login WHERE usuario='" . $_SESSION["user"] . "'";
        $rs3 = $mysqli->query($sql3);

        if ($rs3 -> num_rows > 0){
            $fila3 = mysqli_fetch_assoc($rs3);
            $passwordHash = $fila3["contrasenya"];
            if(password_verify($perfilcontrasenya, $passwordHash)){
                $comprobacionContrasenya = 1; 
           }else{
                $perfilcontrasenyaHash = password_hash($perfilcontrasenya, PASSWORD_BCRYPT);
                $sql4 = "UPDATE users_login SET contrasenya = '$perfilcontrasenyaHash' WHERE idUser =" . $_SESSION['userId'];
                $rs4 = $mysqli->query($sql4);   
            }
        }
    }
    
    if($rs2 || $rs4){
        if ($comprobacionContrasenya == 1){
            header("Location: ../views/perfil.php?comprobacionContrasenya=2&actualizado=1");
        }else{
            header("Location: ../views/perfil.php?actualizado=1");
        }   
        exit();
    } else {
        if ($comprobacionContrasenya == 1){
            header("Location: ../views/perfil.php?comprobacionContrasenya=1");
        }else{
            header("Location: ../views/perfil.php?comprobaciones=1");
        }  
    }
}




include 'cierracnx.php';
?>  