<?php 
include 'abrecnx.php';

$idCitaModAdmin = $_POST['idCitaModAdmin'];


$fechaCita = filter_input(INPUT_POST, "fecha", FILTER_SANITIZE_STRING);
$fechaCita = date('Y-m-d', strtotime(str_replace('-', '/', $fechaCita)));
$motivoCita = filter_input(INPUT_POST, "motivo", FILTER_SANITIZE_STRING);
$fechaActual = date ("Y-m-d");

// se verifica si la fecha de la cita es anterior a la fecha actual
// si es así, se redirige a la página de citas con un mensaje de error
if (strtotime($fechaCita) < strtotime($fechaActual)) {
    header("Location: ../views/citas_admin.php?errCita=2");
}
else{
$sql0 = "SELECT * FROM citas WHERE idCita ='" . $idCitaModAdmin . "'";
$rs0 = $mysqli->query($sql0);
$rowMod = $rs0->fetch_assoc(); 

// se verifica si la fecha y el motivo de la cita son iguales a los ya existentes
if ($fechaCita == $rowMod['fecha_cita'] AND $motivoCita == $rowMod['motivo_cita']){
    header("Location: ../views/citas_admin.php?errCita=3");
}else{ // se actualiza la cita en la base de datos con los nuevos datos
    $sql1 = "UPDATE citas SET fecha_cita = '" . $fechaCita . "', motivo_cita = '" . $motivoCita . "' WHERE idCita =" . $idCitaModAdmin;
    $rs1 = $mysqli->query($sql1);
    if ($rs1){  // si la actualización fue exitosa, se redirige a la página de citas con un mensaje de éxito
        header("Location: ../views/citas_admin.php?modificadaCitaAdmin=1");
    }else{ // si la actualización falló, se redirige a la página de citas con un mensaje de error
        header("Location: ../views/citas_admin.php?errCita=4");
    }
}
}


include 'cierracnx.php';
?>
