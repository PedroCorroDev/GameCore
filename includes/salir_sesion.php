<?php
if (isset($_POST['close'])){
    session_start();
    session_destroy();
    $_SESSION = array();

    header("Refresh:0;url=../index.php");

}
?>