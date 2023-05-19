<?php 

foreach ($_POST as $name => $value) {
    if (strpos($name, 'idAdminCita') === 0) {
        // Extraemos el número que sigue a "idCita"
        $num = substr($name, strlen('idAdminCita'));
        // Comprobamos que sea un número válido
        if (is_numeric($num)) {
            $idCita = $value;
            break;
        }
    }
}

include 'abrecnx.php';
//Borramos la cita cuyo id es el número extraído

$sql= "DELETE FROM citas WHERE idCita ='" .  $idCita . "'";

$rs = $mysqli->query($sql);
if ($rs){
    header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/citas_admin.php?erasedCitaAdmin=1");
}else{
    header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/citas_admin.php?erasedCitaAdmin=0");
}
include 'cierracnx.php';
?>