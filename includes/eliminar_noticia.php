<?php 

foreach ($_POST as $name => $value) {
    if (strpos($name, 'idAdminNoticia') === 0) {
        // Extraemos el número que sigue a "idUser"
        $num = substr($name, strlen('idAdminNoticia'));
        // Comprobamos que sea un número válido
        if (is_numeric($num)) {
            $idNoticia = $value;
            break;
        }
    }
}

include 'abrecnx.php';
//Borramos la noticia cuyo id es el número extraído
$sql = "DELETE FROM noticias WHERE idNoticia ='" .  $idNoticia . "'";
$rs = $mysqli->query($sql);


if ($rs){ //Si se borra correctamente, redirigimos y mostramos un mensaje de éxito
    header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/noticias_admin.php?erasedNoticia=1");
}else{ //Si no se consigue borrar, se redirige y se muestra un error de borrado.
    header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/noticias_admin.php?erasedNoticia=0");
}

include 'cierracnx.php';
?>
