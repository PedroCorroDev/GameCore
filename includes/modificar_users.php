<?php 
include 'abrecnx.php';

$idUserMod = $_POST['idUserMod'];

// Se obtienen los datos del usuario a modificar y se filtran los valores para evitar posibles inyecciones SQL
$nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH);
$apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$telefono = filter_input(INPUT_POST, "telefono", FILTER_SANITIZE_NUMBER_INT);
$fecha_nacimiento = filter_input(INPUT_POST, "fecha_nacimiento", FILTER_SANITIZE_STRING);
$direccion = filter_input(INPUT_POST, "direccion", FILTER_SANITIZE_STRING);
$sexo = filter_input(INPUT_POST, "sexo", FILTER_SANITIZE_STRING);
$rol = filter_input(INPUT_POST, "rol", FILTER_SANITIZE_STRING);




$comprobacionEmail = false;
$comprobacionTelefono = false;

// Se realiza una consulta para obtener los datos del usuario a modificar

$sql0 = "SELECT * FROM users_login UL JOIN users_data UD ON UL.idUser = UD.idUser WHERE UL.idUser = '" . $idUserMod . "'";
$rs0 = $mysqli->query($sql0);
$rowMod = $rs0->fetch_assoc(); 

// Si los valores de los campos son iguales a los que ya existen en la base de datos, no se realiza ninguna modificación
if ($nombre == $rowMod['nombre'] AND $apellidos == $rowMod['apellidos'] AND $email == $rowMod['email'] 
AND $telefono == $rowMod['telefono'] AND $fecha_nacimiento == $rowMod['fNacimiento'] AND $direccion == $rowMod['direccion']
AND $sexo == $rowMod['sexo'] AND $rol == $rowMod['rol']){
    header("Location: ../views/usuarios_admin.php?errUser=0");
}else{ // Se realiza una consulta para comprobar si el teléfono y el email ya existen en otros usuarios
    $sql1 = "SELECT * FROM users_data WHERE idUser != '" . $idUserMod . "'";
    $rs1 = $mysqli->query($sql1);
    while ($fila1 = $rs1->fetch_assoc()) {
        if ($fila1['telefono'] == $telefono) {
            $errorTel = "1";
            break;
        }
    }
    while ($fila1 = $rs1->fetch_assoc()) {
        if ($fila1['email'] == $email) {
            $errorEmail = "1";
            break;
        }
    }

    if($errorTel == "1" || $email == 1){
        header("Location: ../views/usuarios_admin.php?errorTel=". $errorTel . "&errorEmail=". $errorEmail);
    }else{
        $sql2 = "UPDATE users_login SET rol='$rol' WHERE idUser='$idUserMod';";
        $sql3 = "UPDATE users_data SET nombre='$nombre', apellidos='$apellidos', email='$email', telefono='$telefono', fNacimiento='$fecha_nacimiento', direccion='$direccion', sexo='$sexo' WHERE idUser='$idUserMod';";
        $rs2 = $mysqli->query($sql2);
        $rs3 = $mysqli->query($sql3);
        if ($rs2 AND $rs3){
            header("Location: ../views/usuarios_admin.php?modificadoAdmin=1");
        }else{
            header("Location: ../views/usuarios_admin.php?errUser=1");
        }
    }
   
}




include 'cierracnx.php';
?>