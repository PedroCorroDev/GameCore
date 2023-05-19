<?php
// Filtros para sanear los inputs
$nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH);
$apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$telefono = filter_input(INPUT_POST, "telefono", FILTER_SANITIZE_NUMBER_INT);
$fecha_nacimiento = filter_input(INPUT_POST, "fecha_nacimiento", FILTER_SANITIZE_STRING);
$usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);
$contrasenya = filter_input(INPUT_POST, "contrasenya", FILTER_SANITIZE_STRING);



$errores = array();
// Función que detecta si el saneamiento ha borrado el contenido de los inputs
if (!empty($nombre)&&!empty($apellidos)&&!empty($email)&&!empty($telefono)&&!empty($fecha_nacimiento)&&!empty($usuario)&&!empty($contrasenya)){   
  include  "comprobacionAdmin.php";
}else{ //iteramos sobre los inputs para ver cual ha dado error
    if (empty($nombre)) {
      $errores['nombre'] = true;
    } else {$errores['nombre'] = urlencode($nombre);}
    if (empty($apellidos)) {
      $errores['apellidos'] = true;
    } else {$errores['apellidos'] = urlencode($apellidos);}
    if (empty($email)) {
      $errores['email'] = true;
    } else {$errores['email'] = urlencode($email);}
    if (empty($telefono)) {
      $errores['telefono'] = true;
    } else {$errores['telefono'] = urlencode($telefono);}
    if (empty($fecha_nacimiento)) {
      $errores['fecha_nacimiento'] = true;
    } else {$errores['fecha_nacimiento'] = urlencode($fecha_nacimiento);}
    if (empty($usuario)) {
      $errores['usuario'] = true;
    } else {$errores['usuario'] = urlencode($usuario);}
    if (empty($contrasenya)) {
      $errores['contrasenya'] = true;
    } else {$errores['contrasenya'] = urlencode($contrasenya);}
    
    //redirigimos al usuario al formulario
    header("Refresh:0;url=http://localhost/Proyecto%204%20-%20PHP/views/usuarios_admin.php?nombre=".$errores['nombre']."&apellidos=".$errores['apellidos']."&email=".$errores['email']."&telefono=".$errores['telefono']."&fecha_nacimiento=".$errores['fecha_nacimiento']."&usuario=".$errores['usuario']."&contrasenya=".$errores['contrasenya']."&voltear=1");
}
?>