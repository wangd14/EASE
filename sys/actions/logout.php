<?php 
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['points']);
    session_destroy();
    header("Location: ../../index.html");
    exit();
?>