<?php 
include 'abrecnx.php';


$fechaCita = filter_input(INPUT_POST, "fecha", FILTER_SANITIZE_STRING);
$fechaCita = date('Y-m-d', strtotime(str_replace('-', '/', $fechaCita)));
$motivoCita = filter_input(INPUT_POST, "motivo", FILTER_SANITIZE_STRING);
$fechaActual = date ("Y-m-d");
$idUser = $_POST['idUserCitaTo'];


//Comprobacion de límite de citas
 // Si tiene más de 4 citas, se redirecciona a la página de citas con el mensaje de error correspondiente
$sql = "SELECT * FROM citas WHERE idUser ='" . $idUser . "'";
$rs = $mysqli->query($sql);
if ($rs -> num_rows > 4){
    header("Location: ../views/citas_admin.php?errCita=1");
}else{
    if (strtotime($fechaCita) < strtotime($fechaActual)) { 
        // Si la fecha es anterior a la fecha actual, se redirecciona con el mensaje de error correspondiente
        header("Location: ../views/citas_admin.php?errCita=2");
    }
    else{
        $sql1 = "INSERT INTO citas (idUser, fecha_cita, motivo_cita)";
        $sql1.= "VALUES ('". $idUser . "', '" . $fechaCita . " ', '" . $motivoCita . "')";
        $rs1 = $mysqli->query($sql1);
    }
}
if ($rs1){
    header("Location: ../views/citas_admin.php?reservaAdmin=1");
}


include 'cierracnx.php';
?>