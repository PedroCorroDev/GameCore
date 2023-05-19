<?php 
include 'abrecnx.php';


// Obtiene los valores del formulario para actualizar la noticia
$title = $_POST['title'];
$image = filter_input(INPUT_POST, "image", FILTER_VALIDATE_URL);
$body = $_POST['body'];
$fecha = $_POST['fecha'];
$autor = $_POST['autor'];
$idNewToMod = $_POST['idNewToMod'];


// Realiza una consulta a la base de datos para obtener la noticia a modificar
$sql0 = "SELECT * FROM noticias WHERE idNoticia ='" . $idNewToMod . "'";
$rs0 = $mysqli->query($sql0);
$rowMod = $rs0->fetch_assoc(); 
// Compara los valores obtenidos del formulario con los valores actuales de la noticia
// Si los valores son distintos, actualiza la noticia en la base de datos
if ($image==""){
    header("Location: ../views/noticias_admin.php?errImage=1");
}else{
    if ($title == $rowMod['titulo'] && $image == $rowMod['imagen'] && $body == $rowMod['texto'] && $fecha == $rowMod['fecha']){
        header("Location: ../views/noticias_admin.php?errNew=2");
    }else{
        $sql1 = "UPDATE noticias  SET titulo = '" . $title . "', imagen = '" . $image . "', texto = '" . $body . "', fecha = '" . $fecha . "' WHERE idNoticia =" . $idNewToMod;    
        $rs1 = $mysqli->query($sql1);
        if ($rs1){  // Si la actualización es exitosa, redirige a la página de noticias con un mensaje de éxito
            header("Location: ../views/noticias_admin.php?modificadaNewAdmin=1");
        }else{ // Si la actualización falla, redirige a la página de noticias con un mensaje de error
            header("Location: ../views/noticias_admin.php?errNew=3");
        }
    }       
}



include 'cierracnx.php';
?>
