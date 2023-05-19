<?PHP 
    $host = "localhost";
    $usuarioBD = "root";
    $passwordBD  ="";
    $bd = "gamecore"; 

    $mysqli = new mysqli ($host, $usuarioBD, $passwordBD, $bd);

    if ($mysqli->connect_errno) { 
        echo "<p style='color:red;'>Error: No se pudo conectar a  MySQL.</p>" . PHP_EOL; 
        echo "<p>Traza: </p>" . mysqli_connect_errno() . PHP_EOL ; 
        exit; 
    } 
?>