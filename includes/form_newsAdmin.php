<?php 
include 'abrecnx.php';


$title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
$image = filter_input(INPUT_POST, "image", FILTER_VALIDATE_URL);
$body = filter_input(INPUT_POST, "body", FILTER_SANITIZE_STRING);
$fecha = filter_input(INPUT_POST, "fecha", FILTER_SANITIZE_STRING);
$autor = filter_input(INPUT_POST, "autor", FILTER_SANITIZE_STRING);
session_start();
if (empty($autor)){ $autor =  $_SESSION['userId'];}

$errores = array();

if (!empty($title)&&!empty($image)&&!empty($body)&&!empty($fecha)&&!empty($autor)){   

        $sql = "SELECT * FROM noticias WHERE titulo ='" . $title . "'";
        $rs = $mysqli->query($sql);
        if ($rs->num_rows > 0) {
            header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/noticias_admin.php?errNew=1");

        }else{


            $sql1 = "INSERT INTO noticias (titulo, imagen, texto, fecha, idUser) ";
            $sql1.= "VALUES ('". $title . "','" . $image . " ', '" . $body .  " ', '" . $fecha . "', '" . $autor . "')";

            $rs1 = $mysqli->query($sql1);

            if ($rs){
                header("Location: ../views/noticias_admin.php?adminnew=1");
            }
        }
  }else{ //iteramos sobre los inputs para ver cual ha dado error
      if (empty($title)) {
        $errores['title'] = true;
      } else {$errores['title'] = urlencode($title);}
      if (empty($image)) {
        $errores['image'] = true;
      } else {$errores['image'] = urlencode($image);}
      if (empty($body)) {
        $errores['body'] = true;
      } else {$errores['body'] = urlencode($body);}
      if (empty($fecha)) {
        $errores['fecha'] = true;
      } else {$errores['fecha'] = urlencode($fecha);}
     
      
      //redirigimos al usuario al formulario
      header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/../views/noticias_admin.php?title=".$errores['title']."&image=".$errores['image']."&body=".$errores['body']."&fecha=".$errores['fecha']);
  }



include 'cierracnx.php';
?>