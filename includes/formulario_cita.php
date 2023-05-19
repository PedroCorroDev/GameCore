<?php 
include 'abrecnx.php';


$fechaCita = filter_input(INPUT_POST, "fecha", FILTER_SANITIZE_STRING);
$fechaCita = date('Y-m-d', strtotime(str_replace('-', '/', $fechaCita)));
$motivoCita = filter_input(INPUT_POST, "motivo", FILTER_SANITIZE_STRING);
$fechaActual = date ("Y-m-d");


session_start();


//Comprobacion de email y telefono para no repetirlos
$sql = "SELECT * FROM citas WHERE idUser =" . $_SESSION['userId'];
$rs = $mysqli->query($sql);

if ($rs -> num_rows > 4){
    header("Location: ../views/citas.php?errCita=1");
}else{
    if (strtotime($fechaCita) < strtotime($fechaActual)) {
        header("Location: ../views/citas.php?errCita=2");
    }
    else{
        $sql1 = "INSERT INTO citas (idUser, fecha_cita, motivo_cita)";
        $sql1.= "VALUES ('". $_SESSION['userId']. "','" . $fechaCita . " ', '" . $motivoCita . "')";
        $rs1 = $mysqli->query($sql1);
    }
}
if ($rs1){
    header("Location: ../views/citas.php?reserva=1");
}


include 'cierracnx.php';
?>