<?php
  // Establecer conexión a la base de datos
include 'abrecnx.php';

// Preparar los datos para insertar en users_data
$nombreRegistro = $_POST['nombre'];
$apellidosRegistro = $_POST['apellidos']; 
$emailRegistro = $_POST['email'];
$telefonoRegistro = $_POST['telefono'];
$fecha_nacimientoRegistro = $_POST['fecha_nacimiento'];
$direccionRegistro = $_POST['direccion'];
$sexoRegistro = $_POST['sexo'];

// Insertar datos en users_data
$sql1 = "INSERT INTO users_data (nombre, apellidos, email, telefono, fNacimiento, direccion, sexo)
         VALUES ('$nombreRegistro', '$apellidosRegistro', '$emailRegistro', '$telefonoRegistro', '$fecha_nacimientoRegistro', '$direccionRegistro', '$sexoRegistro')";
$rs1 = $mysqli->query($sql1);

if ($rs1) {
    // Obtener el último ID insertado en users_data
    $last_id = mysqli_insert_id($mysqli);

    // Preparar los datos para insertar en users_login
    $usuarioRegistro = $_POST['usuario'];
    $contrasenyaRegistro = password_hash($_POST['contrasenya'], PASSWORD_BCRYPT);
    $rol = $_POST['rol'];

    // Insertar datos en users_login
    $sql2 = "INSERT INTO users_login (idUser, usuario, contrasenya, rol)"; 
    $sql2 .= "VALUES ('$last_id', '$usuarioRegistro', '$contrasenyaRegistro', '$rol')";
    $rs2 = $mysqli->query($sql2);

    if ($rs2) {
      header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/usuarios_admin.php?validadoAdmin=1");
    } else {
    echo "Error: " . $sql2 . "<br>" . $mysqli->error;
    }

} else {
    echo "Error: " . $sql1 . "<br>" . $mysqli->error;
}
  
// Cerrar conexión a la base de datos
include 'cierracnx.php';


?>