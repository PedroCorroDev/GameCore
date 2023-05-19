<?php
include 'abrecnx.php';

//variables de comprobacion de repeticion
$userComprobacion = $_POST['usuario'];
$emailComprobacion = $_POST['email'];
$telefonoComprobacion = $_POST['telefono'];

$comprobacionUsuario = false;
$comprobacionEmail = false;
$comprobacionTelefono = false;


$comprobacionSQL1 = "SELECT email, telefono FROM users_data WHERE email = '$emailComprobacion' OR telefono = '$telefonoComprobacion'";
//Comprobar si se repite alguno de los campos
$comprob1 = mysqli_query($mysqli, $comprobacionSQL1);
while ($fila = mysqli_fetch_array($comprob1)){
    if ($fila['email'] == $email){
        $comprobacionEmail = true;
    }else {
        $comprobacionEmail = false;
     }
    if ($fila['telefono'] == $telefono){
        $comprobacionTelefono = true;
    }else {
        $comprobacionTelefono = false;
     }
}

$comprobacionSQL2 = "SELECT usuario FROM users_login WHERE usuario = '$userComprobacion'";
$comprob2 = mysqli_query($mysqli, $comprobacionSQL2);
while ($fila = mysqli_fetch_array($comprob2)){
    if ($fila['usuario'] == $userComprobacion) {
        $comprobacionUsuario = true;
    } else {
        $comprobacionUsuario = false;
    }
}
include 'cierracnx.php';
//Si alguno de los campos es repetido, se redirecciona mostrando un mensaje de error, sino se registra el usuario
if ($comprobacionUsuario == true || $comprobacionEmail == true || $comprobacionTelefono == true){
   header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/usuarios_admin.php#formulario_user?comprobacionUsuario=".$comprobacionUsuario."&comprobacionEmail=".$comprobacionEmail."&comprobacionTelefono=".$comprobacionTelefono);
}else{
    include 'registrar_usuarioAdmin.php';
}
?>