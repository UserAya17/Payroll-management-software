<?php
    session_start();
    if (!isset($_SESSION['username']))
    {
        $_SESSION['pagecourante'] = $_SERVER['REQUEST_URI'];
        header("location:index.php");
    }
?>