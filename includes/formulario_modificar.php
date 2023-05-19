<?php 
include 'abrecnx.php';

$idCitaMod = $_POST['idCitaModif'];

$fechaCita = filter_input(INPUT_POST, "fecha", FILTER_SANITIZE_STRING);
$fechaCita = date('Y-m-d', strtotime(str_replace('-', '/', $fechaCita)));
$motivoCita = filter_input(INPUT_POST, "motivo", FILTER_SANITIZE_STRING);
$fechaActual = date ("Y-m-d");

//Verificar si la fecha de la cita es menor que la fecha actual

if (strtotime($fechaCita) < strtotime($fechaActual)) {
        header("Location: ../views/citas.php?errCita=2");
}
else{     //Obtener la información actual de la cita
    $sql0 = "SELECT * FROM citas WHERE idCita ='" . $idCitaMod . "'";
    $rs0 = $mysqli->query($sql0);
    $rowMod = $rs0->fetch_assoc(); 
    //Obtener la información actual de la cita
    if ($fechaCita == $rowMod['fecha_cita'] AND $motivoCita == $rowMod['motivo_cita']){
        //Redirigir a la página de citas con un mensaje de error si no hay cambios en la información
        header("Location: ../views/citas.php?errCita=3");
    }else{        //Actualizar la información de la cita en la base de datos
        $sql1 = "UPDATE citas SET fecha_cita = '" . $fechaCita . "', motivo_cita = '" . $motivoCita . "' WHERE idCita =" . $idCitaMod;
        $rs1 = $mysqli->query($sql1);
        if ($rs1){  //Redirigir a la página de citas con un mensaje de éxito si la actualización fue exitosa
            header("Location: ../views/citas.php?modificado=1");
        }else{     //Redirigir a la página de citas con un mensaje de error si la actualización falló
            header("Location: ../views/citas.php?errCita=4");
        }
    }
}



include 'cierracnx.php';
?>