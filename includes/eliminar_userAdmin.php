<?php 

foreach ($_POST as $name => $value) {
    if (strpos($name, 'idUser') === 0) {
        // Extraemos el número que sigue a "idUser"
        $num = substr($name, strlen('idUserEliminar'));
        // Comprobamos que sea un número válido
        if (is_numeric($num)) {
            $idUser = $value;
            break;
        }
    }
}

include 'abrecnx.php';

// Eliminamos la fila correspondiente en la tabla users_login
$sql = "DELETE FROM users_login WHERE idUser ='" .  $idUser . "'";
$rs = $mysqli->query($sql);

// Eliminamos la fila correspondiente en la tabla users_data
$sql1= "DELETE FROM users_data WHERE idUser ='". $idUser . "'";
$rs1 = $mysqli->query($sql1);

if ($rs AND $rs1){
    header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/usuarios_admin.php?erasedAdmin=1");
}else{
    header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/usuarios_admin.php?erased=0");
}

include 'cierracnx.php';
?>

