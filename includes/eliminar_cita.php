
<?php 

foreach ($_POST as $name => $value) {
    if (strpos($name, 'idCita') === 0) {
        // Extraemos el número que sigue a "idCita"
        $num = substr($name, strlen('idCita'));
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
    header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/citas.php?erased=1");
}else{
    header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/citas.php?erased=0");
}

?>