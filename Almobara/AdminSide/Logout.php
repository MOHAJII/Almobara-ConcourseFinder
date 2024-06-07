<?php
    session_start();
    $_SESSION['User_ID'] = null;
    $_SESSION['Username'] = null;
    $_SESSION['AdminName'] = null;
    session_destroy();
    header('Location: login.php');
    exit();

?>
